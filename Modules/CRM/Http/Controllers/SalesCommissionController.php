<?php

namespace Modules\CRM\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CRM\Http\Requests\SalesCommissionRequest;

use Modules\CRM\Entities\SalesCommission;

class SalesCommissionController extends Controller
{
    public function index()
    {
        return response([
            'commissions' => SalesCommission::get()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'commissions' => 'required|array|min:1',
            'commissions.*.sales_id' => 'required|exists:users,id',
            'commissions.*.commission' => 'required|integer|between:1,50'
        ]);

        $commissions = $request->commissions;
        $deletedCommissions = $request->deletedCommissions;

        // delete job titles has deleted
        if (count($request->deletedCommissions) > 0) {
            SalesCommission::whereIn('id', $request->deletedCommissions)->delete();
        }
        /***************************************************/
        for ($x = 0; $x < count($commissions); $x++) {
            SalesCommission::updateOrCreate(
                [
                    'id' => key_exists('id', $commissions[$x]) ? $commissions[$x]['id'] : 0
                ],
                $commissions[$x]
            );
        }
        /***************************************************/
        return response(['message' => 'The commissions has been updated.']);
    }
}
