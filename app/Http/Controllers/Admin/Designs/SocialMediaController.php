<?php

namespace App\Http\Controllers\Admin\Designs;
use App\Http\Controllers\Controller;

use App\Http\Requests\Designs\SocialMediaRequest;
use App\Models\Calendar\Calendar;
use App\Models\CRM\Lead;
use Illuminate\Http\Request;

use App\Models\Designs\SocialMedia;
use App\User;
use Image;

class SocialMediaController extends Controller
{
    public function index()
    {
      $leads = Lead::with('socialMedias')->latest()->get();
      $designers = User::where('department_id', 5)->get();
      return ['leads' => $leads, 'designers' => $designers];
    }

    public function store(SocialMediaRequest $request)
    {
      $name = time() . '.' . explode('/', explode(':',substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
      if (!file_exists(public_path('images/lead-social-media'))) {
        mkdir(public_path('images/lead-social-media'), 0777, true);
      }
      Image::make($request->photo)->resize(280, 200)->save(public_path('images/lead-social-media/').$name);
      $request['photo'] = 'images/lead-social-media/'.$name;

      $socialCreated = SocialMedia::create($request->all());

      /* !!!: Calendar */
      // if($socialCreated){
      //   $socialMedia = SocialMedia::where('media_name', $request->media_name)->first();

      //   $calendar = new Calendar();
      //   $calendar->event_name = $request->media_name;
      //   $calendar->model_id = $socialMedia->id;
      //   $calendar->model_type = "Design\SocialMedia";

      //   $created_date_formation = date('Y-m-d', strtotime($socialMedia->created_at)); // YYYY-mm-dd Formation

      //   $calendar->start_date = $created_date_formation;
      //   $calendar->end_date   = $created_date_formation;

      //   $calendar->save();
      // }
      /* !!!: Calendar */
      return response(['message' => 'Social Media has been created.']);
    }

    public function show($id)
    {
      $lead_name = Lead::findOrFail($id)->name;
      $socialMedia = Lead::findOrFail($id)->socialMedias()->with('user')->get();
      // $designer = $socialMedia->user()->name;
      return ['lead_name' => $lead_name, 'socialMedias' => $socialMedia];
    }

    public function multiDelete(Request $request)
    {
      $get_media = SocialMedia::whereIn('id', $request->id)->get();
      // foreach ($get_media as $value) {
      //   $media_info = SocialMedia::where('id', $value->id)->first();
      //   $calendar = Calendar::where('model_id', $media_info->id)->first();
      //   $calendar->forceDelete();
      // }
      SocialMedia::whereIn('id', $request->id)->delete();
      return ['re' => $request->all()];
    }
}
