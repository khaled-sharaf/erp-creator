<?php

namespace App\Http\Controllers\Admin\Designs;
use App\Http\Controllers\Controller;

use App\Http\Requests\Designs\LogoRequest;
use App\Models\Calendar\Calendar;
use App\Models\CRM\Lead;
use App\Models\CRM\LeadContract;
use Illuminate\Http\Request;

use App\Models\Designs\Logo;
use App\User;
// use Intervention\Image\ImageManagerStatic as Image;
use Image;
use File;

class LogoController extends Controller
{
    public function index()
    {
      $logos = Lead::whereHas('logos')->with('logos')->latest()->paginate(24);
      $designers = User::where('department_id', 5)->get();
      return response(['leads' => $logos, 'designers' => $designers]);
    }

    public function search()
    {
      if($search = \Request::get('q')){
        $leads = Lead::where('name', 'LIKE', "%$search%")->whereHas('logos')->paginate(24);
      }
      return $leads;
    }

    public function store(LogoRequest $request)
    {
      $name = time() . '.' . explode('/', explode(':',substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
      Image::make($request->photo)->resize(200, 120)->save(public_path('images/lead-logos/').$name, 60);
      $request['photo'] = 'images/lead-logos/'.$name;
      $logoCreated = Logo::create($request->all());

      /* !!!: Calendar */
      if($logoCreated){
        $logo = Logo::where('logo_name', $request->logo_name)->first();

        $calendar = new Calendar();
        $calendar->event_name = $request->logo_name;
        $calendar->model_id = $logo->id;
        $calendar->model_type = "Design\Logo";

        $logo_created_date = $logo->created_at;
        $created_date_formation = date('Y-m-d', strtotime($logo_created_date)); // YYYY-mm-dd Formation

        $calendar->start_date = $created_date_formation;
        $calendar->end_date   = $created_date_formation;

        $calendar->save();
      }
      /* !!!: Calendar */

      $leadName = Lead::where('id', $request->lead_id)->pluck('name')->first();
      return response(['message' => 'Logo has been created.', 'leadName' => $leadName, 'logo' => $logoCreated]);
    }

    public function show($id)
    {
      $lead_name = Lead::findOrFail($id)->name;
      $lead_id = Lead::findOrFail($id)->id;
      $logos = Lead::findOrFail($id)->logos()->with('user')->get();
      return ['lead_name' => $lead_name, 'logos' => $logos, 'lead_id' => $lead_id];
    }

    public function update(LogoRequest $request, $id)
    {

    }

    public function destroy($id)
    {
      // $items = Logo::whereIn('id', $id)->get();
      // return ['checkItems' => $items];
      // foreach ($items as $logo) {
      //   $logo->delete();
      // }
      // return response(['status' => true]);
    }

    public function multiDelete(Request $request)
    {
      // return explode(',' , $request);
      // return $request->get('delete-logo');
      $get_logo = Logo::whereIn('id', $request->id)->get();
      foreach ($get_logo as $value) {
        deleteImageModel($value, 'photo');

        $logo_info = Logo::where('id', $value->id)->first();
        $calendar = Calendar::where('model_id', $logo_info->id)->first();
        if($calendar){
          $calendar->forceDelete();
        }
      }
      Logo::whereIn('id', $request->id)->delete();
      return ['re' => $request->all()];

      // $ids = $request->ids;
      // //dd($ids);
      // $logo = Logo::whereIn('id', explode(',', $ids))->get();
      // if($logo){
      //   for ($i=0; $i < count($logo); $i++) {
      //     $logo[$i]->delete();
      //   }

      // }
      // return response()->json([
      //   'status' => 1,
      //   'success' => 'تم الحذف بنجاح',
      // ]);
    }
}
