<?php

namespace App\Http\Controllers\Admin\CRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CRM\LeadRequest;
use Illuminate\Validation\Rule;
use App\Models\CRM\Lead;
use App\Mail\SendMultiMails;
use Mail;

class LeadController extends Controller
{


    private $relation_with = ['user', 'status', 'createdByUser'];


    public function leads_select()
    {
        // ->whereIn('type', [0, 1])
        $leads = Lead::orderBy('id', 'desc');
        if (!auth()->user()->can('admin-crm')) {
            $leads->where('assign_to', auth()->id());
        }
        $leads = $leads->get();
        return response($leads);
    }

    public function leads_search(Request $request)
    {
        $searchValue = $request->searchValue;
        $leads = Lead::query();
        if (!auth()->user()->can('admin-crm')) {
            $leads->where('assign_to', auth()->id());
        }
        $leads->where(function ($query) use ($searchValue) {
            $query->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('phone', 'like', '%' . $searchValue . '%')
                ->orWhere('whatsapp_phone', 'like', '%' . $searchValue . '%')
                ->orWhere('company_name', 'like', '%' . $searchValue . '%');
        });
        $leads = $leads->get();
        return response($leads);
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
        $trashed = $request->trashed;
        $lead_status_id = $request->lead_status_id;
        $created_by = $request->created_by;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $type = $request->type != '' && $request->type != null ? $request->type : 0;
        $type = $request->typeLead != null ? $request->typeLead : $type;
        $query = Lead::select('*')->with($this->relation_with)->orderBy($sortBy, $dir)->where('type', $type);

        // permoission admin
        if (!auth()->user()->can('admin-crm')) {
            $query->where('assign_to', auth()->id());
        }

        // handel leads trashed and not trashed
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

        if ($lead_status_id === 'none') {
            $query->whereNull('lead_status_id');
        } else {
            if ($lead_status_id != '') {
                $query->where('lead_status_id', $lead_status_id);
            }
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
        $leads = $query->paginate($length);
        return response(['data' => $leads, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(LeadRequest $request)
    {
        $formData = $request->validated();
        $formData['company_logo'] = Lead::saveImage($formData['company_logo']);
        $formData['created_by'] = auth()->id();
        if (!auth()->user()->can('admin-crm')) {
            $formData['assign_to'] = auth()->id();
        }
        $leadCreated = Lead::create($formData);
        // send welcome email
        if ($formData['email'] != null) {
            Mail::to($formData['email'])
                ->cc(config('mail.cc'))
                ->send(new SendMultiMails('emails.send.welcome_lead', 'Welcome ' . $formData['name'], $formData));
        }
        /*================================================*/
        return response(['message' => 'Lead has been created.', 'id' => $leadCreated->id]);
    }



    public function show($id)
    {
        $lead = Lead::with($this->relation_with);
        if (!auth()->user()->can('admin-crm')) {
            $lead->where('assign_to', auth()->id());
        }
        $lead = $lead->find($id);
        return response(['lead' => $lead]);
    }



    public function update(LeadRequest $request, $id)
    {
        $formData = $request->validated();
        $lead = Lead::find($id);
        if (strpos($formData['company_logo'], 'data:image/') === 0) {
            $formData['company_logo'] = Lead::saveImage($formData['company_logo'], $lead);
        } else if ($formData['company_logo'] == Lead::DEFAULT_IMAGE && ($lead->company_logo != Lead::DEFAULT_IMAGE && $lead->company_logo != null)) {
            deleteImage(public_path($lead->company_logo));
        }
        // send welcome email
        if ($formData['email'] != null) {
            if ($lead->email == null) {
                Mail::to($formData['email'])
                    ->cc(config('mail.cc'))
                    ->send(new SendMultiMails('emails.send.welcome_lead', 'Welcome ' . $formData['name'], $formData));
            }
        }
        /*================================================*/
        $lead->update($formData);
        return response(['message' => 'Lead has been updated.']);
    }



    public function change_status(Request $request, $id)
    {
        $lead = Lead::find($id);
        $lead->lead_status_id = $request->status_id;
        $lead->save();
        return response(['message' => 'Lead status has been updated.']);
    }



    public function destroy($id)
    {
        $lead = Lead::withTrashed()->where('id', $id)->first();
        if ($lead->trashed()) {
            // delete photo if exists
            deleteImageModel($lead, 'company_logo', Lead::DEFAULT_IMAGE);
            $lead->forceDelete();
        } else {
            $lead->delete();
        }
        return response(['status' => true]);
    }


    public function restoreLead($id)
    {
        $lead_deleted = Lead::onlyTrashed()->where('id', $id)->first();
        $lead_deleted->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Lead::destroy($ids);
        } else if ($action == 'force_delete') {
            $leads = Lead::onlyTrashed()->whereIn('id', $ids)->get();
            foreach ($leads as $lead) {
                deleteImageModel($lead, 'company_logo', Lead::DEFAULT_IMAGE);
                $lead->forceDelete();
            }
        } else if ($action == 'restore') {
            Lead::onlyTrashed()->whereIn('id', $ids)->restore();
        }

        return response(['status' => true]);
    }

    public function leads_new(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:leads',
            'email'=>'required|email|unique:leads',
            'phone'=>'required|unique:leads',
            'whatsapp_phone'=>'required|unique:leads',
            'type'=>['required',
                'numeric',
                Rule::in([0,1,2])
            ]
        ]);

        $lead=Lead::create([
            'name'=>$request['name'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
            'type'=>$request['type'],
            'whatsapp_phone'=>$request['whatsapp_phone']
        ]);

        return response($lead);
    }



}
