<?php

namespace App\Http\Controllers\Admin\Accounting;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Accounting\SupplierRequest;

use App\Models\Accounting\Supplier;

use DB;

class SupplierController extends Controller
{
    

    public function suppliers_select()
    {
        $suppliers = Supplier::latest()->get();
        return response($suppliers);
    }


    public function suppliers_search(Request $request)
    {
        $searchValue = $request->searchValue;
        $suppliers = Supplier::query();
        $suppliers->where(function ($query) use ($searchValue) {
            $query->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('phone', 'like', '%' . $searchValue . '%')
                ->orWhere('whatsapp_phone', 'like', '%' . $searchValue . '%')
                ->orWhere('company_name', 'like', '%' . $searchValue . '%');
        });
        $suppliers = $suppliers->get();
        return response($suppliers);
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
        $query = Supplier::select('*')->orderBy($sortBy, $dir);


        // handel suppliers trashed and not trashed
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
        $suppliers = $query->paginate($length);
        return response(['data' => $suppliers, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(SupplierRequest $request)
    {
        $formData = $request->validated();
        $savingData = array_except($formData, 'services');

        $savingData['logo'] = Supplier::saveImage($savingData['logo']);
        $supplierCreated = Supplier::create($savingData);
        if (count($formData['services']) > 0) {
            $supplierCreated->services()->createMany($formData['services']);
        }
        return response(['message' => 'Supplier has been created.', 'id' => $supplierCreated->id]);
    }



    public function show($id)
    {
        $supplier = Supplier::with('services')->find($id);
        return response(['supplier' => $supplier]);
    }



    public function update(SupplierRequest $request, $id)
    {
        $formData = $request->validated();
        $supplier = Supplier::find($id);
        $savingData = array_except($formData, 'services');

        if (strpos($savingData['logo'], 'data:image/') === 0) {
            $savingData['logo'] = Supplier::saveImage($savingData['logo'], $supplier);
        } else if ($savingData['logo'] == Supplier::DEFAULT_IMAGE && ($supplier->logo != Supplier::DEFAULT_IMAGE && $supplier->logo != null)) {
            deleteImage(public_path($supplier->logo));
        }
        
        $supplier->update($savingData);

        // delete services has deleted
        /***************************************************/
        $services = $formData['services'];
        $deletedServices = $request->deletedServices;
        if (count($deletedServices) > 0) {
            $supplier->services()->whereIn('id', $deletedServices)->delete();
        }
        for ($x = 0; $x < count($services); $x++) {
            // $services[$x] = array_except($services[$x], ['original_services']);
            $supplier->services()->updateOrCreate(
                [
                    'id' => key_exists('id', $services[$x]) ? $services[$x]['id'] : 0
                ],
                $services[$x]
            );
        }
        /***************************************************/

        return response(['message' => 'Supplier has been updated.']);
    }



    public function destroy($id)
    {
        $supplier = Supplier::withTrashed()->where('id', $id)->first();
        if ($supplier->trashed()) {
            // delete photo if exists
            deleteImageModel($supplier, 'logo', Supplier::DEFAULT_IMAGE);
            $supplier->forceDelete();
            $supplier->services()->delete();
        } else {
            $supplier->delete();
        }
        return response(['status' => true]);
    }


    public function restoreSupplier($id)
    {
        $supplier_deleted = Supplier::onlyTrashed()->where('id', $id)->first();
        $supplier_deleted->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Supplier::destroy($ids);
        } else if ($action == 'force_delete') {
            $suppliers = Supplier::onlyTrashed()->whereIn('id', $ids)->get();
            foreach ($suppliers as $supplier) {
                deleteImageModel($supplier, 'logo', Supplier::DEFAULT_IMAGE);
                $supplier->forceDelete();
                $supplier->services()->delete();
            }
        } else if ($action == 'restore') {
            Supplier::onlyTrashed()->whereIn('id', $ids)->restore();
        }

        return response(['status' => true]);
    }



}
