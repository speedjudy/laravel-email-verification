<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;
class CategoryController extends Controller
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
        $categories = DB::table('subpages')->where('user_id', '=', $id)->get();
        return view('category', compact('categories'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($category_name, $user_id, $category_id)
    {
        $categories = DB::table('subpages')->where('user_id', '=', $user_id)->where('category_id', '=', $category_id)->get();
        return view('category', compact('categories', 'category_id'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function category_manage()
    {
        $id = auth::user()->id;
        $categories = DB::table('categories')->where('user_id', '=', $id)->get();
        return view('category_manage', compact('categories'));
    }
    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function category_manage_add(Request $request)
    {
        //
        $data = $request->post();

        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:categories|max:255'
        ]);
        
        if ($validator->fails()) {
            return redirect('category_manage')
                        ->withErrors($validator)
                        ->withInput();
        }
        if ( $data[ 'category_id' ] ) {
            DB::table( 'categories' )->where( 'id', $data[ 'category_id' ] )->update( [
                'category' => $data[ 'category' ]
            ] );
        } else {
            DB::table( 'categories' )->insert( [
                'category' => $data[ 'category' ],
                'user_id' => $data[ 'user_id' ],
            ] );
        }
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_manage_remove(Request $request)
    {
        //
        ini_set('memory_limit', '-1');
        $id = $request->input('id');
        DB::table('categories')->where('id', '=', $id)->delete();
        DB::table('subpages')->where('category_id', '=', $id)->delete();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_manage_get(Request $request)
    {
        //
        ini_set('memory_limit', '-1');
        $id = $request->input('id');
        $data = DB::table('categories')->where('user_id', '=', $id)->get();
        print_r(json_encode($data));
        exit();
    }
}
