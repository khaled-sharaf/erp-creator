<?php

namespace App\Http\Controllers\Admin\Accounting;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Accounting\FixedAssetRequest;

use App\Models\Accounting\FixedAsset;

use DB;

class FixedAssetController extends Controller
{
    public function fixed_assets_select()
    {
        $fixed_assets = FixedAsset::select('id', 'name', 'amount')->latest()->get();
        return response($fixed_assets);
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
        $query = FixedAsset::select('*')->orderBy($sortBy, $dir);

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
        $fixed_assets = $query->paginate($length);
        return response(['data' => $fixed_assets, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(FixedAssetRequest $request)
    {
        $formData = $request->validated();
        FixedAsset::create($formData);
        return response(['message' => 'Fixed asset has been created.']);
    }



    public function show($id)
    {
        $fixed_asset = FixedAsset::find($id);
        return response(['fixed_asset' => $fixed_asset]);
    }



    public function update(FixedAssetRequest $request, $id)
    {
        $formData = $request->validated();
        $fixed_asset = FixedAsset::find($id);
        $fixed_asset->update($formData);
        return response(['message' => 'FixedAsset has been updated.']);
    }


    public function destroy($id)
    {
        FixedAsset::destroy($id);
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;
        if ($action == 'delete') {
            FixedAsset::destroy($ids);
        }
        return response(['status' => true]);
    }
}
