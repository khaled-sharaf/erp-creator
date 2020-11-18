<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test()
    {
      return view('admin.test');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (auth()->check() && auth()->user()->rule == 1) {
        if (auth()->check() && auth()->user()->active == 1) {
            return redirect(env('CP_PREFIX') . '/dashboard');
            // return redirect('/dashboard');
        } else {
            auth()->logout();
            return abort(404);
        }
    }
}
