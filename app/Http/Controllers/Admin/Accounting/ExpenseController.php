<?php

namespace App\Http\Controllers\Admin\Accounting;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Accounting\ExpenseRequest;

use App\Models\Accounting\Expense;

use DB;

class ExpenseController extends Controller
{

    public function expenses_select()
    {
        $expenses = Expense::select('id', 'name', 'amount', 'active')->activate()->latest()->get();
        return response($expenses);
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
        $active = $request->active;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $query = Expense::select('*')->orderBy($sortBy, $dir);


        if ($active != '') {
            $query->where('active', $active);
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
        $expenses = $query->paginate($length);
        return response(['data' => $expenses, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(ExpenseRequest $request)
    {
        $formData = $request->validated();
        Expense::create($formData);
        return response(['message' => 'Expense has been created.']);
    }



    public function show($id)
    {
        $expense = Expense::find($id);
        return response(['expense' => $expense]);
    }



    public function update(ExpenseRequest $request, $id)
    {
        $formData = $request->validated();
        $expense = Expense::find($id);
        $expense->update($formData);
        return response(['message' => 'Expense has been updated.']);
    }


    public function destroy($id)
    {
        Expense::destroy($id);
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;
        if ($action == 'delete') {
            Expense::destroy($ids);
        }
        return response(['status' => true]);
    }


}
