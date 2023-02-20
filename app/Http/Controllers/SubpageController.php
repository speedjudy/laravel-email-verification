<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubpageController extends Controller
 {
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */

    public function index( $category_id, $sid = null )
    {
        if ($sid) {
            $subpage = DB::table('subpages')->where('id', '=', $sid)->get();
            return view('subpage', compact('subpage', 'category_id'));
        } else {
            $subpage = [];
            return view('subpage', compact('subpage', 'category_id'));
        }
    }
    public function view( $sid )
    {
        $subpage = DB::table('subpages')->where('id', '=', $sid)->get();
        return view('subpage_view', compact('subpage'));
    }
    /**
    * Store the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function add( Request $request )
    {
        //
        $data = $request->post();
        if ( $data[ 'subpage_id' ] ) {
            DB::table( 'subpages' )->where( 'id', $data[ 'subpage_id' ] )->update( [
                'title' => $data[ 'subpage_title' ],
                'description' => $data[ 'description' ],
                'status' => $data[ 'status' ],
                'tags' => $data[ 'tags' ],
                'category_id' => $data['category_id'],
            ] );
        } else {
            DB::table( 'subpages' )->insert( [
                'title' => $data[ 'subpage_title' ],
                'description' => $data[ 'description' ],
                'status' => $data[ 'status' ],
                'tags' => $data[ 'tags' ],
                'user_id' => $data[ 'user_id' ],
                'category_id' => $data['category_id'],
                'created_at' => new \DateTime()
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
    public function remove($id)
    {
        //
        ini_set('memory_limit', '-1');
        DB::table('subpages')->where('id', '=', $id)->delete();
        return redirect()->back();
    }
}
