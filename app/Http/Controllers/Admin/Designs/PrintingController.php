<?php

namespace App\Http\Controllers\Admin\Designs;
use App\Http\Controllers\Controller;

use App\Http\Requests\Designs\PrintingRequest;
use App\Models\Calendar\Calendar;
use App\Models\CRM\Lead;
use Illuminate\Http\Request;

use App\Models\Designs\Printing;
use App\User;
use Image;

class PrintingController extends Controller
{
    public function index()
    {
      $leads = Lead::with('printings')->latest()->get();
      $designers = User::where('department_id', 5)->get();
      return ['leads' => $leads, 'designers' => $designers];
    }

    public function store(PrintingRequest $request)
    {
      $name = time() . '.' . explode('/', explode(':',substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
      if (!file_exists(public_path('images/lead-printings'))) {
        mkdir(public_path('images/lead-printings'), 0777, true);
      }
      Image::make($request->photo)->resize(280, 200)->save(public_path('images/lead-printings/').$name);
      $request['photo'] = 'images/lead-printings/'.$name;
      $printingCreated = Printing::create($request->all());

      /* !!!: Calendar */
      // if($printingCreated){
      //   $printing = Printing::where('printing_name', $request->printing_name)->first();

      //   $calendar = new Calendar();
      //   $calendar->event_name = $request->printing_name;
      //   $calendar->model_id = $printing->id;
      //   $calendar->model_type = "Design\Printing";

      //   $created_date_formation = date('Y-m-d', strtotime($printing->created_at)); // YYYY-mm-dd Formation

      //   $calendar->start_date = $created_date_formation;
      //   $calendar->end_date   = $created_date_formation;

      //   $calendar->save();
      // }
      /* !!!: Calendar */
      return response(['message' => 'Printing has been created.']);
    }

    public function show($id)
    {
      $lead_name = Lead::findOrFail($id)->name;
      $printing = Lead::findOrFail($id)->printings()->with('user')->get();
      return ['lead_name' => $lead_name, 'printings' => $printing];
    }

    public function multiDelete(Request $request)
    {
      $get_printing = Printing::whereIn('id', $request->id)->get();
      // foreach ($get_printing as $value) {
      //   $printing_info = Printing::where('id', $value->id)->first();
      //   $calendar = Calendar::where('model_id', $printing_info->id)->first();
      //   $calendar->forceDelete();
      // }
      Printing::whereIn('id', $request->id)->delete();
      return ['re' => $request->all()];
    }
}
