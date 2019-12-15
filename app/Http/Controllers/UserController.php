<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Session;

class UserController extends Controller
{

    public function index(){

        if(!Session::exists('userid')){
            return redirect('login');
        }
        
        $roleData = DB::table('roles')
        ->select()
        ->orderBy('id', 'desc')
        ->get();

        $userData = DB::table('users')
        ->select('users.*', 'roles.id as roles_id', 'roles.description as description')
        ->join('roles', 'users.roles_id', '=', 'roles.id')
        ->orderBy('users.id', 'desc')
        ->get();
        
        return view('user/index', ["roleData" => $roleData, "userData" => $userData]);
    }

    public function create(Request $request){

        $result = DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'roles_id' => $request->input('roles_id'),
            'created_date' => date('Y-m-d')
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to save data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully saved."]);
    }

    public function fetch_data(Request $request) {

        $result = DB::table('users')
        ->select('users.*', 'roles.id as roles_id')
        ->join('roles', 'users.roles_id', '=', 'roles.id')
        ->where('users.id', $request->input('id'))
        ->get();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to fetch data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully fetching data.", "data" => $result]);
    }

    public function update(Request $request) {
        $result = DB::table('users')
        ->where('id', $request->input('id'))
        ->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'roles_id' => $request->input('roles_id'),
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to update data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully updated."]);
    }

    public function delete(Request $request) {
        $result = DB::table('users')
        ->where('id', $request->input('id'))
        ->delete();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to delete data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully deleted."]);
    }
}
