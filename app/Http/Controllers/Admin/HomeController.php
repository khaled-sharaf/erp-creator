<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class HomeController extends Controller
{

    public function index()
    {
        if (auth()->check() && auth()->user()->active == 1) {
            return view('admin.cp_layout');
        } else {
            auth()->logout();
            return redirect()->route('login');
        }
    }


    public function hrModelsCounts() {

        $counts = [

            'users' => User::count(),
            'departments' => 100,
            'requests' => 33,
            'vacations' => 20,
            'contracts' => 30
        ];


        return response(['counts' => $counts]);
    }




}
