<?php

namespace App\Http\Controllers\Admin\WebDevelopment;
use App\Http\Controllers\Controller;

use App\Http\Requests\WebDevelopment\HostingRequest;
use App\Models\Calendar\Calendar;
use Illuminate\Http\Request;

use App\Models\WebDevelopment\Hosting;

class HostingController extends Controller
{
  public function hostings_select()
    {
        $hostings = Hosting::orderBy('id', 'desc')->get();
        return response($hostings);
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
        $query = Hosting::select('*')->orderBy($sortBy, $dir);

        // handel hostings trashed and not trashed
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
        $hostings = $query->paginate($length);
        return response(['data' => $hostings, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }

    public function store(HostingRequest $request)
    {
      $host = Hosting::create($request->all());

      // if($host){
      //   $hosting = Hosting::where('hosting_name', $request->hosting_name)->first();

      //   $calendar = new Calendar();
      //   $calendar->event_name = $request->hosting_name;
      //   $calendar->model_id = $hosting->id;
      //   $calendar->model_type = "WebDevelopment\Hosting";
      //   $calendar->start_date = $hosting->booking_date;
      //   $calendar->end_date = $hosting->renewal_date;

      //   $calendar->save();
      // }


      return response(['message' => 'Host has been created.']);
    }

    public function update(HostingRequest $request, $id)
    {
        $hosting = Hosting::find($id);

        // $calendar = Calendar::where('event_name', $hosting->hosting_name)->first();

        $updated_hosting =  $hosting->update($request->all());

        // if($updated_hosting){
        //   $calendar->event_name = $request->hosting_name;
        //   $calendar->start_date = $hosting->booking_date;
        //   $calendar->end_date = $hosting->renewal_date;
        //   $calendar->update();
        // }

        return response(['message' => 'Hosting has been updated.']);
    }

    public function show($id)
    {
      $hosting = Hosting::findOrFail($id);
      return response(['hosting' => $hosting]);
    }

    public function destroy($id)
    {
        $hosting = Hosting::withTrashed()->where('id', $id)->first();
        // $calendar = Calendar::withTrashed()->where('event_name', $hosting->hosting_name)->first();

        if ($hosting->trashed()) {
            $hosting->forceDelete();
            // $calendar->forceDelete();
        } else {
            $hosting->delete();
            // $calendar->delete();
        }
        return response(['status' => true]);
    }

    public function restoreHostings($id)
    {
        $hosting_deleted = Hosting::onlyTrashed()->where('id', $id)->first();
        // $calendar_deleted = Calendar::onlyTrashed()
        //       ->where('event_name', $hosting_deleted->hosting_name)->first();

        $hosting_deleted->restore();
        // $calendar_deleted->restore();
        return response(['status' => true]);
    }

    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Hosting::destroy($ids);
        } else if ($action == 'force_delete') {
            Hosting::onlyTrashed()->whereIn('id', $ids)->forceDelete();
        } else if ($action == 'restore') {
            Hosting::onlyTrashed()->whereIn('id', $ids)->restore();
        }
        return response(['status' => true]);
    }
}
