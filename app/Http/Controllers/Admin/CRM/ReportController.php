<?php

namespace App\Http\Controllers\Admin\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


// models
use App\Models\CRM\Lead;
use App\Models\CRM\Meeting;
use App\Models\CRM\LeadContract;
use App\User;
use App\Models\CRM\Service;

// models relations
use App\Models\CRM\LeadStatus;
use App\Models\CRM\SalesCommission;
use App\Models\CRM\ContractPayment;

use DB;

class ReportController extends Controller
{

    // return all total counts of models or by personal salse

    public function totalCounts(Request $request)
    {
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
            },
            'services AS ads_amount' => function ($q) {
                $q->where('profit_method', 0)->select(DB::raw("SUM(amount) as ads_amount"));
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
        if (auth()->user()->can('admin-crm')) {
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
            if (auth()->user()->can('admin-crm')) {
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
        $meetings_next_meeting_counts = $data_meetings->filter(function ($value) {
            return $value->status === 'next_meeting';
        });
        $meetings_project_delay_counts = $data_meetings->filter(function ($value) {
            return $value->status === 'project_delay';
        });
        $meetings_refused_offer_counts = $data_meetings->filter(function ($value) {
            return $value->status === 'refused_offer';
        });
        $meetings_rejected_counts = $data_meetings->filter(function ($value) {
            return $value->status === 'rejected';
        });
        $meetings_none_counts = $data_meetings->filter(function ($value) {
            return $value->status === null;
        });
        // $meetings_grouped = $data_meetings->groupBy(function ($value) {
        //     return $value->status != null;
        // })->first()->groupBy('status')->toArray();
        // $meetings_grouped_counts = [];
        // foreach ($meetings_grouped as $key => $value) {
        //     $meetings_grouped_counts[$key] = count($value);
        // }
        // $meetings_none_counts = $data_meetings->filter(function ($value) {
        //     return $value->status === null;
        // });
        // $meetings_return = array_merge([
        //     'total' => $data_meetings->count(),
        //     'none' => $meetings_none_counts->count()
        // ], $meetings_grouped_counts);
        /*******************************************************************************************/

        // filter contracts
        $contracts = $contracts->get();
        // add sales commission
        $contracts_additional_sales_commission = [];
        $contracts = $contracts->toArray();
        foreach ($contracts as $contract) {
            if (array_key_exists('personal_sales_commission', $contract) && $contract['personal_sales_commission'] != null) {
                $contract['sales_commission'] = intval($contract['profit_company'] * ($contract['personal_sales_commission']['commission'] / 100));
            } else {
                $contract['sales_commission'] = 0;
            }
            $contracts_additional_sales_commission[] = $contract;
        }
        /****************************************************/
        $contracts = collect(json_decode(json_encode($contracts_additional_sales_commission), false));
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
                'next_meeting'      => $meetings_next_meeting_counts->count(),
                'project_delay'     => $meetings_project_delay_counts->count(),
                'refused_offer'     => $meetings_refused_offer_counts->count(),
                'rejected'          => $meetings_rejected_counts->count(),
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
