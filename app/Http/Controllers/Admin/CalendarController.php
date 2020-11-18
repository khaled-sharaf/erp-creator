<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CalendarResource;
use App\Models\Calendar\Calendar;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends Controller
{
    public function index()
    {
        // return CalendarResource::collection(Calendar::all());
        $calendar = CalendarResource::collection(Calendar::all());
        $trashed = Calendar::onlyTrashed()->get();
        return ['calendar' => $calendar, 'trashed' => $trashed];
    }

    public function search()
    {
      // $leads = Lead::where(function($query) use ($search, $x){
      //   $query->where('name', 'LIKE', "%$search%");
      // })->paginate(5);
      if($search = \Request::get('q')){
        $events = Calendar::where(function($query) use ($search){
          $query->where('event_name', 'LIKE', "%$search%");
        })->get();
      }
      // return $events;
      return CalendarResource::collection($events);
    }

    public function store(Request $request)
    {
        $new_calendar = Calendar::create($request->all());
        return response()->json([
          'data' => new CalendarResource($new_calendar),
          'message' => 'Successfully added a new event',
          'status' => Response::HTTP_CREATED
        ]);
    }

    public function show(Calendar $calendar)
    {
        return response($calendar, Response::HTTP_OK);
    }

    public function Update(Request $request, Calendar $calendar, $id)
    {
      $calendar = Calendar::findOrFail($id);
      $updated_event = $calendar->update($request->all());
        return response()->json([
          'data' => Calendar::findOrFail($id),
          'message' => 'Successfully updated event!',
          'status' => Response::HTTP_ACCEPTED
        ]);
    }

    public function destroy($id)
    {
        $calendar = Calendar::findOrFail($id);

        if ($calendar->trashed()) {
            $calendar->forceDelete();
        } else {
            $calendar->delete();
        }

        return response('Event removed Successfully', Response::HTTP_NO_CONTENT);
    }

    public function onlyTrashed()
    {
      // return CalendarResource::collection(Calendar::all());
      $calendar = Calendar::where('deleted_at', NULL)->get();
        return Calendar::onlyTrashed()->get();
    }
}
