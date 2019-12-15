<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Session;

class LoginController extends Controller
{
    public function index(){

        Session::forget('userid');
        Session::forget('username');
        Session::forget('email');
        Session::forget('password');
        Session::forget('roles');

        return view('login');
    }

    public function fetch_data(Request $request) {

        $result = DB::table('users')
        ->select()
        ->where([
            ['email', $request->input('email')],
            ['password', $request->input('password')],
        ])
        ->limit(1)
        ->get();

        if($result->count() < 1){
            return response()->json(["code" => "99", "message" => "Please check your credentials."]);
        }
        
        Session::put('userid', $result[0]->id);
        Session::put('username', $result[0]->name);
        Session::put('email', $result[0]->email);
        Session::put('password', $result[0]->password);
        Session::put('roles', $result[0]->roles_id);

        return response()->json(["code" => "00", "message" => "Successfully logged-in."]);
    }
}
