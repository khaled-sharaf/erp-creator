<?php

namespace App\Http\Controllers\Admin\CRM;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CRM\QuotationRequest;

use App\Models\CRM\Quotation;
use App\Models\CRM\Lead;
use App\User;
use DB;
use PDF;
use File;

use App\Mail\SendQuotation;
use Mail;

class QuotationController extends Controller
{
    
	private $relation_with_index = ['lead', 'services', 'personalSales'];
    private $relation_with_profile = [];
    private $relation_with_sum_payments = [];


    public function __construct()
    {
        $this->relation_with_sum_payments['services AS services_amount'] = function ($q) {
            $q->select(DB::raw("SUM(amount) as services_amount"));
        };

        // $this->relation_with_sum_payments['services AS profit_company'] = function ($q) {
        //     $q->where('profit_method', 1)->select(DB::raw("SUM(amount) as profit_company"));
        // };

        // $this->relation_with_sum_payments['services AS profit_ads'] = function ($q) {
        //     $q->where('profit_method', 0)->select(DB::raw("SUM(amount) as profit_ads"));
        // };

        $this->relation_with_profile = array_merge($this->relation_with_index, ['services.originalServices']);
    }





    public function index(Request $request)
    {
        $sortBy = $request->sortBy;
        $length = $request->length;
        $dir = $request->dir;
        $draw = $request->draw;
        $searchValue = $request->search;
        $searchColumnSelected = $request->searchColumnSelected;
        $searchColumns = array_slice($request->searchColumns, 1);
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Quotation::select('*')
            ->with($this->relation_with_index)
            ->withCount($this->relation_with_sum_payments)
            ->whereHas('lead', function ($q) {
                $q->whereNull('deleted_at');
            })
            ->with('currency')
            ->orderBy($sortBy, $dir);

        // permoission admin
        if (!auth()->user()->can('admin-crm')) {
            $query->where('sales_id', auth()->id());
        }

        if ($from_date != '') {
            $query->where('created_at', '>=', $from_date);
        }
        if ($to_date != '') {
            $query->where('created_at', '<=', $to_date);
        }

        if ($searchValue) {
            if (in_array('all', $searchColumnSelected)) {
                $query->where(function($query) use ($searchValue, $searchColumns) {
                    foreach($searchColumns as $column) {
                        $query->orWhere($column, 'like', '%' . $searchValue . '%');
                    }
                });
            } else {
                $query->where(function($query) use ($searchValue, $searchColumnSelected) {
                    foreach($searchColumnSelected as $column) {
                        $query->orWhere($column, 'like', '%' . $searchValue . '%');
                    }
                });
            }
        }
        $quotation = $query->paginate($length);
        return response(['data' => $quotation, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(QuotationRequest $request)
    {
        $formData = $request->validated();
        $total_amount = $request->total_amount;
        $quotation = [
            'lead_id' => $formData['lead_id'],
            'sales_id' => $formData['sales_id'],
            'total_amount' => $total_amount,
            'currency_id'=>$formData['currency_id'],
            'secret_id' => str_random(30)
        ];
        $quotationCreated = Quotation::create($quotation);
        $quotationCreated->services()->createMany($formData['services']);
        return response(['message' => 'Quotation has been created.']);
    }



    public function show($id)
    {
        $quotation = Quotation::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)
        ->whereHas('lead', function ($q) {
            $q->whereNull('deleted_at');
        })->find($id);

        return response(['quotation' => $quotation]);
    }



    public function update(QuotationRequest $request, $id)
    {
        $formData = $request->validated();
        $quotation = Quotation::find($id);

        $total_amount = $request->total_amount;
        $contract = [
            'total_amount' => $total_amount,
            'currency_id'=>$formData['currency_id'],
        ];
        $quotation->update($contract);

        // delete services has deleted
        /***************************************************/
        $services = $formData['services'];
        $deletedServices = $request->deletedServices;
        if (count($deletedServices) > 0) {
            $quotation->services()->whereIn('id', $deletedServices)->delete();
        }
        for ($x = 0; $x < count($services); $x++) {
            $services[$x] = array_except($services[$x], ['original_services']);
            $quotation->services()->updateOrCreate(
                [
                    'id' => key_exists('id', $services[$x]) ? $services[$x]['id'] : 0
                ],
                $services[$x]
            );
        }
        /***************************************************/
        return response(['message' => 'Quotation has been updated.']);
    }


    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);
				$quotation->delete();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Quotation::destroy($ids);
        }
        return response(['status' => true]);
    }




    public function viewQuotationPDF($secret_id)
    {
        $quotation = Quotation::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)->where('secret_id', $secret_id)->first();

        $pdf = PDF::loadView('pdf.quotation.quotation', compact('quotation'));
        $pdf_name='pdf/'.time().'.pdf';
        $pdf->save('pdf/'.time().'.pdf');
        return redirect($pdf_name);
        return $pdf->stream(date('Y-m-d') . "-quotation-" . $quotation->id . ".pdf");
    }


    public function sendQuotationToMail($id)
    {
        $quotation = Quotation::with($this->relation_with_profile)
                    ->withCount($this->relation_with_sum_payments)->find($id);
        $lead = $quotation->lead;

        // send welcome email
        if ($lead->email != null) {
            $pdfQuotation = PDF::loadView('pdf.quotation.quotation', compact('quotation'))->output();
            $dataMail = [
                'secret_id' => $quotation->secret_id,
                'name' => $lead->name,
                'quotation' => $quotation
            ];
            Mail::to($lead->email) 
                ->cc(config('mail.cc'))
                ->send(new SendQuotation($dataMail, $pdfQuotation));
            return response(['message' => 'success']);
        }
        return response(['message' => 'lead_not_has_email']);
    }
}
