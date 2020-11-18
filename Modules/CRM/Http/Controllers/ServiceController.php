<?php

namespace Modules\CRM\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CRM\Http\Requests\ServiceRequest;

use Modules\CRM\Entities\Service;

class ServiceController extends Controller
{

    public function services_select()
    {
        $services = Service::latest()->get();
        return response($services);
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
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Service::select('*')->orderBy($sortBy, $dir);

        if($request->has('range'))
        {
            $query->whereBetween('created_at', [
                date('Y-m-d H:i:s',strtotime($request['range'][0])), 
                date('Y-m-d H:i:s',strtotime($request['range'][1]))
            ]);
        }

        // handel services trashed and not trashed
        if ($trashed == 0) {
            $query->onlyTrashed();
        } else if ($trashed == 2) {
            $query->withTrashed();
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
        $services = $query->paginate($length);
        return response(['data' => $services, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(ServiceRequest $request)
    {
        $formData = $request->validated();
        Service::create($formData);
        return response(['message' => 'Service has been created.']);
    }



    public function show($id)
    {
        $service = Service::find($id);
        return response(['service' => $service]);
    }



    public function update(ServiceRequest $request, $id)
    {
        $formData = $request->validated();
        $service = Service::find($id);
        $service->update($formData);
        return response(['message' => 'Service has been updated.']);
    }




    public function destroy($id)
    {
        $service = Service::withTrashed()->where('id', $id)->first();
        if ($service->trashed()) {
            $service->forceDelete();
        } else {
            $service->delete();
        }
        return response(['status' => true]);
    }


    public function restoreService($id)
    {
        $service_deleted = Service::onlyTrashed()->where('id', $id)->first();
        $service_deleted->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Service::destroy($ids);
        } else if ($action == 'force_delete') {
            Service::onlyTrashed()->whereIn('id', $ids)->forceDelete();
        } else if ($action == 'restore') {
            Service::onlyTrashed()->whereIn('id', $ids)->restore();
        }
        return response(['status' => true]);
    }

}
