<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsermanageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('usermanage', compact('users'));
    }

    /**
     * Store the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //
        $data = $request->post();
        $validatFlag = true;
        if ($data['flag']==='edit') {
            $check = DB::table('users')->where('id', '=', $data['user_id'])->first();
            if ($check->email === $data['email']) {
                $validatFlag = false;
            }
        }

        if ($validatFlag) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|max:255'
            ]);
            
            if ($validator->fails()) {
                return redirect('user')
                            ->withErrors($validator)
                            ->withInput();
            }
        }
        if ($data['flag']==='save') {
            DB::table('users')->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'verified' => 1,
                'permission' => $data['permission'],
                'password' => bcrypt($data['pwd']),
            ]);
        } else {
            DB::table('users')->where('id', $data['user_id'])->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'permission' => $data['permission'],
                'password' => bcrypt($data['pwd']),
            ]);
        }
        return redirect()->back();
    }
    /**
     * Get the form for editing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        //
        ini_set('memory_limit', '-1');
        $id = $request->input('id');
        $data = DB::table('users')->where('id', '=', $id)->get();
        print_r(json_encode($data));
        exit();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        //
        ini_set('memory_limit', '-1');
        $id = $request->input('id');
        DB::table('users')->where('id', '=', $id)->delete();
    }
}
