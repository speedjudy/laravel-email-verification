<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Invite;
use Auth;

class InvitemanageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        $id = auth::user()->id;
        $invites_data = DB::table('invites')->where('user_id', '=', $id)->where('deleted', '=', 0)->get();
        return view('invite', compact('invites_data'));
    }
    /**
     * Invite the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //
        $this->middleware('auth');
        $data = $request->post();

        $validator = Validator::make($request->all(), [
            'invited_email' => 'required|unique:invites|max:255'
        ]);
        
        if ($validator->fails()) {
            return redirect('invite')
                        ->withErrors($validator)
                        ->withInput();
        }
        DB::table( 'invites' )->insert( [
            'invited_email' => $data['invited_email'],
            'user_id' => $data['user_id'],
            'invite_uri' => md5($data['user_id'].'_invited_'.$data['invited_email'].time()),
            'created_at' => new \DateTime(),
        ] );
        return redirect()->back();
    }
    /**
     * Connect the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function connect($uri)
    {
        $invite_data = DB::table('invites')->where('invite_uri', '=', $uri)->first();
        
        
        if ($invite_data) {
            $invite_email = $invite_data->invited_email;
            $check = Invite::checkExpire($uri);
            if ($check=="expired") {
                DB::table( 'invites' )->where( 'invite_uri', $uri)->update( [
                    'expired' => 1,
                    'status' => 2
                ] );
                return view('expired');
            } else if($invite_data->deleted){
                return redirect('404');
            } else {
                // print_r($invite_data->status!=1);die();
                if ($invite_data->status!=1) {
                    $user = DB::table('users')->where('id', $invite_data->user_id)->first();
                    DB::table( 'invites' )->where( 'invite_uri', $uri)->update( [
                        'status' => 1
                    ] );
                    DB::table('users')->insert([
                        'name' => "User",
                        'email' => $invite_data->invited_email,
                        'verified' => 1,
                        'permission' => $user->permission,
                        'password' => bcrypt('user123'),
                    ]);
                }
                return redirect('login');
            }
        } else {
            return redirect('404');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $this->middleware('auth');
        //
        ini_set('memory_limit', '-1');
        $id = $request->input('id');
        // DB::table( 'invites' )->where( 'id', $id)->update( [
        //     'deleted' => 1
        // ] );
        $data = DB::table('invites')->where('id', $id)->first();
        DB::table( 'users' )->where( 'email', '=', $data->invited_email)->delete();

        DB::table( 'invites' )->where( 'id', '=', $id)->delete();
    }
}
