<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Session;

class PasswordController extends Controller
{
    public function index(){

        if(!Session::exists('userid')){
            return redirect('login');
        }

        return view('password/index');
    }

    public function update(Request $request) {
        $result = DB::table('users')
        ->where('id', $request->input('id'))
        ->update([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => $request->input('password'),
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to update data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully updated."]);
    }
}
