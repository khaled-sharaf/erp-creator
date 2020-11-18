<?php

namespace Modules\Accounting\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Accounting\Http\Requests\AccountRequest;

use Modules\Accounting\Entities\Account;
use Modules\Accounting\Entities\Payment;

use DB;

class AccountController extends Controller
{

    public function accounts_select(Request $request)
    {
        $accounts = Account::query();
        if ($request->has('kind')) {
            $accounts->where('kind', $request->kind);
        }
        $accounts = $accounts->latest()->get();
        return response($accounts);
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
        $kind = $request->kind;
        $query = Account::orderBy($sortBy, $dir)->with('payments');

        if ($kind === 'bank') {
            $query->bank();
        } else if ($kind === 'cash') {
            $query->cash();
        } else if ($kind === 'partner') {
            $query->partner();
        }


        // handel accounts trashed and not trashed
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
        $accounts = $query->paginate($length);
        return response(['data' => $accounts, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }



    public function store(AccountRequest $request)
    {
        $formData = $request->validated();
        $accountCreated = Account::create($formData);
        return response(['message' => 'Account has been created.', 'id' => $accountCreated->id]);
    }



    public function show($id)
    {
        $account = Account::find($id);
        return response(['account' => $account]);
    }



    public function update(AccountRequest $request, $id)
    {
        $formData = $request->validated();
        $account = Account::find($id);
        $account->update($formData);
        return response(['message' => 'Account has been updated.']);
    }



    public function destroy($id)
    {
        $account = Account::withTrashed()->where('id', $id)->first();
        if ($account->trashed()) {
            // delete photo if exists
            $account->payments()->forceDelete();
            $account->forceDelete();
        } else {
            $account->payments()->delete();
            $account->delete();
        }
        return response(['status' => true]);
    }


    public function restoreAccount($id)
    {
        $account_deleted = Account::onlyTrashed()->where('id', $id)->first();
        $account_deleted->restore();
        $account_deleted->payments()->restore();
        return response(['status' => true]);
    }


    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Account::destroy($ids);
            Payment::whereIn('account_id', $ids)->delete();
        } else if ($action == 'force_delete') {
            Account::onlyTrashed()->whereIn('id', $ids)->forceDelete();
            Payment::whereIn('account_id', $ids)->forceDelete();
        } else if ($action == 'restore') {
            Account::onlyTrashed()->whereIn('id', $ids)->restore();
            Payment::whereIn('account_id', $ids)->restore();
        }

        return response(['status' => true]);
    }
}
