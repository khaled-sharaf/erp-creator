<?php

namespace Modules\CRM\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\CRM\Entities\LeadStatus;

class LeadStatusController extends Controller
{

    public function index()
    {
        return response([
            'statuses' => LeadStatus::get()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'statuses' => 'required|array|min:1',
            'statuses.*.name' => 'required|string|between:2,180',
            'statuses.*.color' => 'required|string|max:20'
        ]);

        $statuses = $request->statuses;
        $deletedStatuses = $request->deletedStatuses;

        // delete lead statuses has deleted
        if (count($deletedStatuses) > 0) {
            LeadStatus::whereIn('id', $deletedStatuses)->delete();
        }
        /***************************************************/
        for ($x = 0; $x < count($statuses); $x++) {
            LeadStatus::updateOrCreate(
                [
                    'id' => key_exists('id', $statuses[$x]) ? $statuses[$x]['id'] : 0
                ],
                $statuses[$x]
            );
        }
        /***************************************************/
        return response(['message' => 'The statuses has been updated.']);
    }
}
