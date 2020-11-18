<?php

namespace App\Http\Controllers\Admin\CRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CRM\LeadContractRequest;

use App\Models\CRM\LeadContract;
use App\Models\CRM\ContractPayment;
use App\Models\CRM\Lead;
use App\User;
use DB;
use PDF;
use File;

use App\Mail\SendInvoice;
use App\Mail\SendContract;
use App\Models\Calendar\Calendar;
use DateTime;
use Mail;

class LeadContractController extends Controller
{
    private $relation_with_index = ['lead', 'personalSales', 'personalSales.jobTitle', 'personalSalesCommission', 'createdByUser', 'project'];
    private $relation_with_profile = [];
    private $relation_with_sum_payments = [];
    private $name_days = ['الأحد', 'الإثنين',  'الثلاثاء',  'الأربعاء',  'الخميس',  'الجمعة',  'السبت'];


    public function __construct()
    {
        $this->relation_with_sum_payments['payments AS paid_amount'] = function ($q) {
            $q->select(DB::raw("SUM(amount) as paid_amount"));
        };

        $this->relation_with_sum_payments['services AS services_amount'] = function ($q) {
            $q->select(DB::raw("SUM(amount) as services_amount"));
        };

        $this->relation_with_sum_payments['services AS profit_company'] = function ($q) {
            $q->where('profit_method', 1)->select(DB::raw("SUM(amount) as profit_company"));
        };

        $this->relation_with_sum_payments['services AS profit_ads'] = function ($q) {
            $q->where('profit_method', 0)->select(DB::raw("SUM(amount) as profit_ads"));
        };

        $this->relation_with_profile = array_merge($this->relation_with_index, ['services', 'services.originalServices', 'terms', 'payments']);
    }


    // public function lead_contracts_select()
    // {
    //     $lead_contracts = LeadContract::orderBy('id', 'desc')->get();
    //     return response($lead_contracts);
    // }


    public function index(Request $request)
    {
        $sortBy = $request->sortBy;
        $length = $request->length;
        $dir = $request->dir;
        $draw = $request->draw;
        $searchValue = $request->search;
        $searchColumnSelected = $request->searchColumnSelected;
        $searchColumns = array_slice($request->searchColumns, 1);
        $trashed = $request->trashed;
        $created_by = $request->created_by;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = LeadContract::select('*')
            ->with($this->relation_with_index)
            ->withCount($this->relation_with_sum_payments)
            ->whereHas('lead', function ($q) {
                $q->whereNull('deleted_at')
                  ->where('type', '2');
            })
            ->with('currency')
            ->orderBy($sortBy, $dir);

        // permoission admin
        if (!auth()->user()->can('admin-crm')) {
            $query->where('sales_id', auth()->id());
        }

        // handel lead_contracts trashed and not trashed
        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
        }

        if ($created_by != '') {
            $query->where('created_by', $created_by);
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
                        if ($column == 'lead_id') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('name', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'lead_phone') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('phone', 'like', '%' . $searchValue . '%')
                                    ->orWhere('whatsapp_phone', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'company_name') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('company_name', 'like', '%' . $searchValue . '%');
                            });
                        } else {
                            $query->orWhere($column, 'like', '%' . $searchValue . '%');
                        }
                    }
                });
            } else {
                $query->where(function($query) use ($searchValue, $searchColumnSelected) {
                    foreach($searchColumnSelected as $column) {
                        if ($column == 'lead_id') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('name', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'lead_phone') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('phone', 'like', '%' . $searchValue . '%')
                                    ->orWhere('whatsapp_phone', 'like', '%' . $searchValue . '%');
                            });
                        } else if ($column == 'company_name') {
                            $query->orWhereHas('lead', function($q) use ($searchValue) {
                                $q->where('company_name', 'like', '%' . $searchValue . '%');
                            });
                        } else {
                            $query->orWhere($column, 'like', '%' . $searchValue . '%');
                        }
                    }
                });
            }
        }
        $lead_contracts = $query->paginate($length);
        return response(['data' => $lead_contracts, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(LeadContractRequest $request)
    {
        $formData = $request->validated();
        $total_amount = $request->total_amount;
        $tax = $request->tax;
        $contract = [
            'lead_id' => $formData['lead']['id'],
            'sales_id' => $formData['personal_sales']['id'],
            'job_title_lead' => $formData['job_title_lead'],
            'start_date' => $formData['start_date'],
            'duration' => $formData['duration'],
            'duration_unit' => $formData['duration_unit'],
            'note' => $formData['note'],
            'total_amount' => $total_amount,
            'currency_id'=>$formData['currency_id'],
            'tax' => $tax,
            'created_at'=>$formData['created_at'],
            'created_by' => auth()->id(),
            'secret_id' => str_random(30)
        ];
        if (array_key_exists('created_at', $formData) && $formData['created_at'] != '') {
            $contract['created_at'] = $formData['created_at'];
        }
        $contractCreated = LeadContract::create($contract);

        Lead::where('id',$formData['lead']['id'])->update([
            'type'=>2
        ]);

        /* !!!: Calendar */
        // if($contractCreated){
        //   $leadContract = LeadContract::where('secret_id', $contract['secret_id'])->first();
        //   $lead = Lead::where('id', $leadContract->lead_id)->first();

        //   $calendar = new Calendar();
        //   $calendar->event_name = $lead->name;
        //   $calendar->model_id = $leadContract->id;
        //   $calendar->model_type = "CRM\LeadContract";
        //   $calendar->start_date = $leadContract->start_date;
        //   $date = new DateTime($calendar->start_date);
        //   // Adding
        //   $date->modify('+'. $leadContract->duration .'months');
        //   // Checking
        //   $end_date = $date->format('Y-m-d');
        //   $calendar->end_date = $end_date;
        //   $calendar->save();
        // }
        /* !!!: Calendar */
        for($i=0;$i<count($formData['services']);$i++)
        {
            if(isset($formData['services'][$i]['original_services']))
            {
              unset($formData['services'][$i]['original_services']);
            }
            unset($formData['services'][$i]['id']);
        }

        $contractCreated->terms()->createMany($formData['terms']);
        $contractCreated->services()->createMany($formData['services']);

        $lead = Lead::find($formData['lead']['id']);
        $formData['lead']['type'] = 2;
        $lead->update($formData['lead']);
        $lead->meetings()->update(['status' => 'done']);
        $personal_sales = User::find($formData['personal_sales']['id']);
        $personal_sales->update($formData['personal_sales']);

        // send welcome email
        // if ($lead->email != null) {
        //     $dataMail = [
        //         'secret_id' => $contract['secret_id'],
        //         'name' => $lead->name
        //     ];
        //     $name_days = $this->name_days;
        //     $contract = LeadContract::where('secret_id', $contract['secret_id'])->with($this->relation_with_profile)
        //                             ->withCount($this->relation_with_sum_payments)->first();
        //     $pdfData = PDF::loadView('pdf.contract.contract', compact('contract', 'name_days'))->output();
        //     Mail::to($lead->email)
        //         ->cc(config('mail.cc'))
        //         ->send(new SendContract($dataMail, $pdfData));
        // }
        /*================================================*/

        return response(['message' => 'Lead contract has been created.', 'id' => $contractCreated->id]);
    }



    public function show($id)
    {
        $lead_contract = LeadContract::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)
        ->whereHas('lead', function ($q) {
            $q->whereNull('deleted_at')
            ->where('type', '2');
        })

        ->find($id);
        return response(['lead_contract' => $lead_contract]);
    }



    public function update(LeadContractRequest $request, $id)
    {
        $formData = $request->validated();
        $lead_contract = LeadContract::find($id);

        $total_amount = $request->total_amount;
        $contract = [
            'job_title_lead' => $formData['job_title_lead'],
            'start_date' => $formData['start_date'],
            'duration' => $formData['duration'],
            'duration_unit' => $formData['duration_unit'],
            'note' => $formData['note'],
            'total_amount' => $total_amount,
            'currency_id'=>$formData['currency_id'],
            'created_at'=>$formData['created_at'],
        ];
        if (array_key_exists('created_at', $formData)) {
            $contract['created_at'] = $formData['created_at'];
        }

        // $lead = Lead::where('id', $lead_contract->lead_id)->first();
        // $calendar = Calendar::where('event_name', $lead->name)->first();

        $lead_contract->update($contract);

        Lead::where('id',$formData['lead']['id'])->update([
            'type'=>2
        ]);

        /* !!!: Calendar */
          // $calendar->start_date = $lead_contract->start_date;
          // $date = new DateTime($calendar->start_date);
          // // Adding
          // $date->modify('+'. $lead_contract->duration .'months');
          // // Checking
          // $end_date = $date->format('Y-m-d');
          // $calendar->end_date = $end_date;

          // $calendar->update();
        /* !!!: Calendar */

        // delete services has deleted
        /***************************************************/
        $services = $formData['services'];
        $deletedServices = $request->deletedServices;
        if (count($deletedServices) > 0) {
            $lead_contract->services()->whereIn('id', $deletedServices)->delete();
        }
        for ($x = 0; $x < count($services); $x++) {
            $services[$x] = array_except($services[$x], ['original_services']);
            $lead_contract->services()->updateOrCreate(
                [
                    'id' => key_exists('id', $services[$x]) ? $services[$x]['id'] : 0
                ],
                $services[$x]
            );
        }
        /***************************************************/

        // delete terms has deleted
        /***************************************************/
        $terms = $formData['terms'];
        $deletedTerms = $request->deletedTerms;
        if (count($deletedTerms) > 0) {
            $lead_contract->terms()->whereIn('id', $deletedTerms)->delete();
        }
        for ($x = 0; $x < count($terms); $x++) {
            $lead_contract->terms()->updateOrCreate(
                [
                    'id' => key_exists('id', $terms[$x]) ? $terms[$x]['id'] : 0
                ],
                $terms[$x]
            );
        }
        /***************************************************/

        $lead_contract->lead()->update($formData['lead']);
        $lead_contract->personalSales()->update($formData['personal_sales']);

        return response(['message' => 'Lead contract has been updated.']);
    }


    public function destroy($id)
    {
        $lead_contract = LeadContract::withTrashed()->where('id', $id)->first();

        // $calendar = Calendar::withTrashed()->where('model_id', $lead_contract->id)->first();

        if ($lead_contract->trashed()) {
            $lead_contract->forceDelete();
            // $calendar->forceDelete();
        } else {
            $lead_contract->delete();
            // $calendar->delete();
        }
        return response(['status' => true]);
    }


    public function restoreLeadContract($id)
    {
        $lead_contract_deleted = LeadContract::onlyTrashed()->where('id', $id)->first();
        /* !!!: Calendar */
        // $calendar_deleted = Calendar::onlyTrashed()
        //       ->where('start_date', $lead_contract_deleted->start_date)->first();

        // $calendar_deleted->restore();
        /* !!!: Calendar */

        $lead_contract_deleted->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            LeadContract::destroy($ids);
        } else if ($action == 'force_delete') {
            LeadContract::onlyTrashed()->whereIn('id', $ids)->forceDelete();
        } else if ($action == 'restore') {
            LeadContract::onlyTrashed()->whereIn('id', $ids)->restore();
        }

        return response(['status' => true]);
    }


    public function getPayments($id)
    {
        $lead_contract = LeadContract::with(['lead', 'payments'])->withCount($this->relation_with_sum_payments)->find($id);
        return response([
            'lead_contract' => $lead_contract
        ]);
    }

    public function updatePayments(Request $request, $id)
    {
        $lead_contract = LeadContract::find($id);
        $request->validate([
            'payments' => 'nullable|array',
            'payments.*.date' => 'required|date',
            'payments.*.amount' => 'required|integer|min:10,max:1000000',
            'payments.*.profit_method' => 'required|boolean',
            'payments.*.payment_method' => 'required|in:1,2,3',
            'payments.*.description' => 'nullable|string|max:300',
        ]);

        $payments = $request->payments;
        $deletedPayments = $request->deletedPayments;

        // delete lead contract payments has deleted
        if (count($deletedPayments) > 0) {
            $lead_contract->payments()->whereIn('id', $deletedPayments)->delete();
        }
        /***************************************************/
        for ($x = 0; $x < count($payments); $x++) {
            $lead_contract->payments()->updateOrCreate(
                [
                    'id' => key_exists('id', $payments[$x]) ? $payments[$x]['id'] : 0
                ],
                $payments[$x]
            );
        }
        /***************************************************/
        return response(['message' => 'The payments has been updated.']);
    }

    public function sendInvoiceToMail($id)
    {
        $name_days = $this->name_days;
        $payment = ContractPayment::find($id);
        $contract = LeadContract::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)->find($payment->lead_contract_id);
        $lead = $contract->lead;

        // send welcome email
        if ($lead->email != null) {
            $pdfInvoice = PDF::loadView('pdf.contract.invoice', compact('contract', 'name_days'))->output();
            $pdfReceipt = PDF::loadView('pdf.accounting.receipt', compact('payment', 'lead'))->output();
            $dataMail = [
                'secret_id' => $contract->secret_id,
                'name' => $lead->name,
                'payment' => $payment
            ];
            Mail::to($lead->email)
                ->cc(config('mail.cc'))
                ->send(new SendInvoice($dataMail, $pdfInvoice, $pdfReceipt));
            return response(['message' => 'success']);
        }
        return response(['message' => 'lead_not_has_email']);
    }


    public function saveContractPDF($id)
    {
        $name_days = $this->name_days;
        $contract = LeadContract::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)->find($id);

        $pdf = PDF::loadView('pdf.contract.contract', compact('contract', 'name_days'));
        return $pdf->stream(date('Y-m-d') . "-contract-" . $id . ".pdf");
    }


    public function viewContractPDF($secret_id)
    {
        $name_days = $this->name_days;
        $contract = LeadContract::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)->where('secret_id', $secret_id)->first();

        $pdf = PDF::loadView('pdf.contract.contract', compact('contract', 'name_days'));
        return $pdf->stream(date('Y-m-d') . "-contract-" . $contract->id . ".pdf");
    }

    public function viewInvoicePDF($secret_id)
    {
        $name_days = $this->name_days;
        $contract = LeadContract::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)->where('secret_id', $secret_id)->first();
        $pdf = PDF::loadView('pdf.contract.invoice', compact('contract', 'name_days'));
        return $pdf->stream(date('Y-m-d') . "-invoice-" . $contract->id . ".pdf");
    }


    public function receiptPDF($id)
    {
        $payment = ContractPayment::find($id);
        $lead = LeadContract::find($payment->lead_contract_id)->lead;
        $pdf = PDF::loadView('pdf.accounting.receipt', compact('payment', 'lead'));
        return $pdf->stream(date('Y-m-d') . "-receipt-$id.pdf");
    }

    public function renewal($id)
    {
        $lead_contract = LeadContract::with($this->relation_with_profile)
        ->withCount($this->relation_with_sum_payments)
        ->whereHas('lead', function ($q) {
            $q->whereNull('deleted_at')
            ->where('type', '2');
        })
        ->find($id);

        return response(['lead_contract' => $lead_contract]);
    }

    public function renewal_submit(LeadContractRequest $request)
    {
        $formData = $request->validated();
        $total_amount = $request->total_amount;
        $tax = $request->tax;
        $contract = [
            'lead_id' => $formData['lead']['id'],
            'sales_id' => $formData['personal_sales']['id'],
            'job_title_lead' => $formData['job_title_lead'],
            'start_date' => $formData['start_date'],
            'duration' => $formData['duration'],
            'duration_unit' => $formData['duration_unit'],
            'note' => $formData['note'],
            'total_amount' => $total_amount,
            'currency_id'=>$formData['currency_id'],
            'tax' => $tax,
            'created_at'=>$formData['created_at'],
            'created_by' => auth()->id(),
            'secret_id' => str_random(30)
        ];
        if (array_key_exists('created_at', $formData) && $formData['created_at'] != '') {
            $contract['created_at'] = $formData['created_at'];
        }
        $contractCreated = LeadContract::create($contract);

        /* !!!: Calendar */
        // if($contractCreated){
        //   $leadContract = LeadContract::where('secret_id', $contract['secret_id'])->first();
        //   $lead = Lead::where('id', $leadContract->lead_id)->first();

        //   $calendar = new Calendar();
        //   $calendar->event_name = $lead->name;
        //   $calendar->model_id = $leadContract->id;
        //   $calendar->model_type = "CRM\LeadContract";
        //   $calendar->start_date = $leadContract->start_date;
        //   $date = new DateTime($calendar->start_date);
        //   // Adding
        //   $date->modify('+'. $leadContract->duration .'months');
        //   // Checking
        //   $end_date = $date->format('Y-m-d');
        //   $calendar->end_date = $end_date;
        //   $calendar->save();
        // }
        /* !!!: Calendar */

        

        $contractCreated->terms()->createMany($formData['terms']);
        $contractCreated->services()->createMany($formData['services']);

        $lead = Lead::find($formData['lead']['id']);
        $formData['lead']['type'] = 2;
        $lead->update($formData['lead']);
        $lead->meetings()->update(['status' => 'done']);
        $personal_sales = User::find($formData['personal_sales']['id']);
        $personal_sales->update($formData['personal_sales']);

        // send welcome email
        // if ($lead->email != null) {
        //     $dataMail = [
        //         'secret_id' => $contract['secret_id'],
        //         'name' => $lead->name
        //     ];
        //     $name_days = $this->name_days;
        //     $contract = LeadContract::where('secret_id', $contract['secret_id'])->with($this->relation_with_profile)
        //                             ->withCount($this->relation_with_sum_payments)->first();
        //     $pdfData = PDF::loadView('pdf.contract.contract', compact('contract', 'name_days'))->output();
        //     Mail::to($lead->email)
        //         ->cc(config('mail.cc'))
        //         ->send(new SendContract($dataMail, $pdfData));
        // }
        /*================================================*/

        return response(['message' => 'Lead contract has been created.', 'id' => $contractCreated->id]);
    }


}
