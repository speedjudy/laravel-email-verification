<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfilemanageController extends Controller
{
    use AuthenticatesUsers;
    
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
        $user = auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Store the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $data = $request->post();
        $edit_data = [
            'company' => $data['company'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'vat_number' => $data['vat_number'],
            'address' => $data['address']
        ];
        if ($data['pwd']=='on') {
            $edit_data['password'] = bcrypt($data['new_pwd']);
        }
        DB::table('users')->where('id', $data['user_id'])->update($edit_data);

        return redirect()->back();
    }
    /**
     * Check current password the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkPwd(Request $request)
    {
        $current_pwd = $request->input('current_pwd');
        $result = "right";
        $check = DB::table('users')->where('id', '=', $request->input('user_id'))->first();
        if(Hash::check($current_pwd, $check->password)) {
            // Right password
            $result = "right";
        } else {
            // Wrong one
            $result = "wrong";
        }
        echo $result;
        exit();
    }
}
