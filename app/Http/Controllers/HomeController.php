<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth::user()->id;

        $admin = DB::table('users')->where('permission', '=', 1)->first();
        
        $categories = DB::table('categories')->where('user_id', '=', $admin->id)->get();

        return view('home', compact('categories'));
    }
}
