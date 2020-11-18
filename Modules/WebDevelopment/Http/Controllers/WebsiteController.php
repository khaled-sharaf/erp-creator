<?php

namespace Modules\WebDevelopment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use App\User;
use Modules\CRM\Entities\Lead;
use Modules\WebDevelopment\Entities\Website;
use Modules\WebDevelopment\Http\Requests\WebsiteRequest;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $web = Lead::whereHas('websites')->with('websites')->latest()->paginate(24);
      $leads = Lead::select('name', 'id')->get();
      $designers = User::where('department_id', 6)->get();
      return ['leads' => $web, 'designers' => $designers, 'leads_names' => $leads];
    }

    public function search($query)
    {

      $leads = Lead::where('name', 'LIKE', "%$query%")->whereHas('websites')->paginate(24);

      return ['leads' => $leads];
    }

    public function store(WebsiteRequest $request)
    {
      if (!file_exists(public_path('images/lead-websites'))) {
        mkdir(public_path('images/lead-websites'), 0777, true);
      }

      $data = $request->document;
      // $fileName = time() . $request->text;
      $fileName = $request->text;

      if(!is_file(public_path('\images\lead-websites\\'.$fileName))){
        $myfile = fopen(public_path('\images\lead-websites\\'.$fileName), "w");
        fwrite($myfile, $data);
      }

      $docs = 'images/lead-websites/'.$fileName;
      $arr = [];
      foreach ($request->user_id as $lead) {
        array_push($arr, $lead['id']);
      }
      $web = Website::create([
        'website_name' => $request->website_name,
        'lead_id' => $request->lead_id,
        'document' => $docs,
      ]);
      $web->users()->attach($arr);
      $web->save();
      $leadName = Lead::where('id', $request->lead_id)->pluck('name')->first();
      return response(['message' => 'Website has been created.', 'leadName' => $leadName, 'web' => $web]);
    }

    public function show($id)
    {
      $lead_id = Lead::findOrFail($id);
      $lead_name = $lead_id->whereHas('websites', function($q) use($lead_id) {
        $q->where('lead_id', $lead_id->id);
      })->pluck('name')->first();
      $websites = Lead::findOrFail($id)->websites->all();
      $push_docs = [];

      foreach ($websites as $value) {
        $name = str_replace('/', '\\', $value->document);
        $docs_name = public_path($name);

        $file = file_get_contents($docs_name);
        array_push($push_docs, $file);


        // $docs_data = fopen($docs_name, 'r+');
        // $docs_data = fopen($name, 'r+');
      }

      $users = [];
      foreach ($websites as $value) {
        $fetch_users = $value->users()->where('department_id', 6)->get();
        array_push($users, $fetch_users);
      }

      return ['lead_name' => $lead_name, 'users' => $users, 'websites' => $websites, 'docs' => $push_docs];
    }

    public function multiDelete(Request $request)
    {
      $web = Website::whereIn('id', $request->id)->get();
      $userPivot = [];

      foreach ($web as $value) {

        $users = $value->users()->get();

        foreach ($users as $user) {
          array_push($userPivot, $user->id);
        }

        $value->users()->detach($userPivot);

        unlink(public_path($value->document));
      }
      Website::whereIn('id', $request->id)->delete();

      return ['re' => $request->all()];
    }
}
