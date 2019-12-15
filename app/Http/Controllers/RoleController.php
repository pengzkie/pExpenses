<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UpdateRolesRequest;
use App\Role;
use Session;

class RoleController extends Controller
{

    public function index(){

        if(!Session::exists('userid')){
            return redirect('login');
        }

        $roleData = DB::table('roles')
        ->select()
        ->orderBy('id', 'desc')
        ->get();
        
        return view('role/index', ["roleData" => $roleData]);
    }

    public function create(Request $request){

        $result = DB::table('roles')->insert([
            'description' => $request->input('description'),
            'created_date' => date('Y-m-d')
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to save data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully saved."]);
    }

    public function fetch_data(Request $request) {

        $result = DB::table('roles')
        ->select()
        ->where('id', $request->input('id'))
        ->get();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to fetch data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully fetching data.", "data" => $result]);
    }

    public function update(Request $request) {
        $result = DB::table('roles')
        ->where('id', $request->input('id'))
        ->update([
            'description' => $request->input('description'),
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to update data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully updated."]);
    }

    public function delete(Request $request) {
        $result = DB::table('roles')
        ->where('id', $request->input('id'))
        ->delete();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to delete data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully deleted."]);
    }
}
