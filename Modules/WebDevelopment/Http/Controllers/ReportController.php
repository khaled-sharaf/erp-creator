<?php

namespace Modules\WebDevelopment\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// models
use Modules\CRM\Entities\Lead;
use Modules\CRM\Entities\Meeting;
use Modules\CRM\Entities\LeadContract;
use Modules\CRM\Entities\Service;

// models relations
use Modules\CRM\Entities\LeadStatus;
use Modules\WebDevelopment\Entities\Domain;
use Modules\WebDevelopment\Entities\Hosting;
use Modules\WebDevelopment\Entities\Website;
use DB;

class ReportController extends Controller
{
    // return all total counts of models or by personal salse
    public function totalCounts(Request $request)
    {

      $hosts = Hosting::count();
      $hosts_total_price = Hosting::sum('price');

      $webs = Website::select('lead_id')->distinct()->get();
      $webs = count($webs);

      $domains = Domain::count();
      $domains_total_price = Domain::sum('price');

      return ['hosts' => $hosts, 'hosts_total_price' => $hosts_total_price,
              'webs' => $webs,
              'domains' => $domains, 'domains_total_price' => $domains_total_price];



        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $user_id = $request->user_id;


        $leads = Lead::where('type', 0);
        $clients = Lead::where('type', 2);
        $meetings = Meeting::onlyParents()->select('status');
        $services = Service::orderBy('id');
        /*******************************************************************************************/

        $contracts_with = ['personalSalesCommission'];
        $contracts_payments = [
            'payments AS paid_amount' => function ($q) {
                $q->select(DB::raw("SUM(amount) as paid_amount"));
            },
            'services AS services_amount' => function ($q) {
                $q->select(DB::raw("SUM(amount) as services_amount"));
            },
            'services AS profit_company' => function ($q) {
                $q->where('profit_method', 1)->select(DB::raw("SUM(amount) as profit_company"));
            }
        ];

        $contracts = LeadContract::select('sales_id', 'tax', 'total_amount')
                    ->with($contracts_with)
                    ->withCount($contracts_payments);
        /*******************************************************************************************/

        // where date and sales
        if ($from_date != '') {
            $leads->whereDate('created_at', '>=', $from_date);
            $clients->whereDate('created_at', '>=', $from_date);
            $meetings->whereDate('created_at', '>=', $from_date);
            $contracts->whereDate('created_at', '>=', $from_date);
            $services->whereDate('created_at', '>=', $from_date);
        }
        if ($to_date != '') {
            $leads->whereDate('created_at', '<=', $to_date);
            $clients->whereDate('created_at', '<=', $to_date);
            $meetings->whereDate('created_at', '<=', $to_date);
            $contracts->whereDate('created_at', '<=', $to_date);
            $services->whereDate('created_at', '<=', $to_date);
        }
        if (auth()->user()->can('admin-web-development')) {
            if ($user_id != '') {
                $leads->where('assign_to', $user_id);
                $clients->where('assign_to', $user_id);
                $meetings->where('created_by', $user_id);
                $contracts->where('sales_id', $user_id);
            }
        } else {
            $leads->where('assign_to', auth()->id());
            $clients->where('assign_to', auth()->id());
            $meetings->where('created_by', auth()->id());
            $contracts->where('sales_id', auth()->id());
        }
        /*******************************************************************************************/

        // lead statuses
        $lead_statuses = LeadStatus::select('name', 'color')->withCount(['leads' => function ($q) use ($user_id) {
            $q->where('type', 0);
            if (auth()->user()->can('admin-web-development')) {
                if ($user_id != '') {
                    $q->where('assign_to', $user_id);
                }
            } else {
                $q->where('assign_to', auth()->id());
            }
        }])->get();
        /*******************************************************************************************/


        // filter meetings by statuses
        $data_meetings = $meetings->get();
        $meetings_done_counts = $data_meetings->filter(function ($value) {
            return $value->status === 'done';
        });
        $meetings_none_counts = $data_meetings->filter(function ($value) {
            return $value->status === null;
        });

        // filter contracts
        $contracts = $contracts->get();
        // add sales commission
        $contracts_additional_sales_commission = [];
        foreach ($contracts as $contract) {
            $contract['sales_commission'] = intval($contract['profit_company'] * ($contract['personalSalesCommission']['commission'] / 100));
            $contracts_additional_sales_commission[] = $contract;
        }
        /****************************************************/
        $contracts = collect($contracts_additional_sales_commission);
        /****************************************************/
        $total_current_contracts = $contracts->filter(function ($value) {
            return $value->total_amount > $value->paid_amount;
        });
        /****************************************************/
        $total_ended_contracts = $contracts->filter(function ($value) {
            return $value->paid_amount >= $value->total_amount;
        });
        /*******************************************************************************************/


        $data = [
            'leads' => [
                'total' => $leads->count(),
                'statuses' => $lead_statuses,
            ],
            // 'meetings' => $meetings_return,
            'meetings' => [
                'total'             => $data_meetings->count(),
                'done'              => $meetings_done_counts->count(),
                'none'              => $meetings_none_counts->count(),
            ],
            'all_contracts' => [
                'total' => $contracts->count(),
                'total_amount' => $contracts->sum('total_amount'),
                'paid_amount' => $contracts->sum('paid_amount'),
                'remaining_amount' => $contracts->sum('total_amount') - $contracts->sum('paid_amount'),
                'profit_company' => $contracts->sum('profit_company'),
                'ads_amount' => $contracts->sum('ads_amount'),
                'sales_commission' => $contracts->sum('sales_commission')
            ],
            'current_contracts' => [
                'total' => $total_current_contracts->count(),
                'total_amount' => $total_current_contracts->sum('total_amount'),
                'total_amount' => $total_current_contracts->sum('total_amount'),
                'paid_amount' => $total_current_contracts->sum('paid_amount'),
                'remaining_amount' => $total_current_contracts->sum('total_amount') - $total_current_contracts->sum('paid_amount'),
                'profit_company' => $total_current_contracts->sum('profit_company'),
                'ads_amount' => $total_current_contracts->sum('ads_amount'),
                'sales_commission' => $total_current_contracts->sum('sales_commission')
            ],
            'paid_contracts' => [
                'total' => $total_ended_contracts->count(),
                'total_amount' => $total_ended_contracts->sum('total_amount'),
                'total_amount' => $total_ended_contracts->sum('total_amount'),
                'paid_amount' => $total_ended_contracts->sum('paid_amount'),
                'remaining_amount' => $total_ended_contracts->sum('total_amount') - $total_ended_contracts->sum('paid_amount'),
                'profit_company' => $total_ended_contracts->sum('profit_company'),
                'ads_amount' => $total_ended_contracts->sum('ads_amount'),
                'sales_commission' => $total_ended_contracts->sum('sales_commission')
            ],
            'clients' => [
                'total' => $clients->count(),
            ],
            'services' => [
                'total' => $services->count()
            ],
        ];

        return response(['data' => $data]);
    }

}
