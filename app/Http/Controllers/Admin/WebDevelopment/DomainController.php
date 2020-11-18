<?php

namespace App\Http\Controllers\Admin\WebDevelopment;
use App\Http\Controllers\Controller;

use App\Http\Requests\WebDevelopment\DomainRequest;
use App\Models\Calendar\Calendar;
use Illuminate\Http\Request;

use App\Models\WebDevelopment\Domain;

class DomainController extends Controller
{
  public function domains_select()
    {
        $domains = Domain::orderBy('id', 'desc')->get();
        return response($domains);
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
        $query = Domain::select('*')->orderBy($sortBy, $dir);

        // handel domains trashed and not trashed
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
        $domains = $query->paginate($length);
        return response(['data' => $domains, 'draw' => $draw, 'sortBy' => $sortBy, 'dir' => $dir]);
    }

    public function store(DomainRequest $request)
    {
      $created_domain = Domain::create($request->all());

      /* !!!: Calendar */
      // if($created_domain){
      //   $domain = Domain::where('domain_name', $request->domain_name)->first();

      //   $calendar = new Calendar();
      //   $calendar->event_name = $request->domain_name;
      //   $calendar->model_id = $domain->id;
      //   $calendar->model_type = "WebDevelopment\Domain";
      //   $calendar->start_date = $domain->booking_date;
      //   $calendar->end_date   = $domain->renewal_date;

      //   $calendar->save();
      // }
      /* !!!: Calendar */

      return response(['message' => 'Host has been created.']);
    }

    public function update(DomainRequest $request, $id)
    {
        $domain = Domain::find($id);

        // $calendar = Calendar::where('event_name', $domain->domain_name)->first();

        $domain->update($request->all());

        /* !!!: Calendar */
          // $calendar->event_name = $request->name;
          // $calendar->start_date = $domain->hiring_date;

          // $calendar->update();
        /* !!!: Calendar */


        return response(['message' => 'Domain has been updated.']);
    }

    public function show($id)
    {
      $domain = Domain::findOrFail($id);
      return response(['domain' => $domain]);
    }

    public function destroy($id)
    {
        $domain = Domain::withTrashed()->where('id', $id)->first();
        // $calendar = Calendar::withTrashed()->where('event_name', $domain->domain_name)->first();

        if ($domain->trashed()) {
            $domain->forceDelete();
            // $calendar->forceDelete();
        } else {
            $domain->delete();
            // $calendar->delete();
        }
        return response(['status' => true]);
    }

    public function restoreDomains($id)
    {
        $domain_deleted = Domain::onlyTrashed()->where('id', $id)->first();
        /* !!!: Calendar */
        // $calendar_deleted = Calendar::onlyTrashed()
        //       ->where('event_name', $domain_deleted->domain_name)->first();

        // $calendar_deleted->restore();
        /* !!!: Calendar */
        $domain_deleted->restore();
        return response(['status' => true]);
    }

    public function deleteRestoreMulti(Request $request)
    {
        $ids = $request->ids;
        $action = $request->action;

        if ($action == 'delete') {
            Domain::destroy($ids);
        } else if ($action == 'force_delete') {
            Domain::onlyTrashed()->whereIn('id', $ids)->forceDelete();
        } else if ($action == 'restore') {
            Domain::onlyTrashed()->whereIn('id', $ids)->restore();
        }
        return response(['status' => true]);
    }
}
