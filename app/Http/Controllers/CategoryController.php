<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use Session;

class CategoryController extends Controller
{

    public function index(){

        if(!Session::exists('userid')){
            return redirect('login');
        }

        $categoryData = DB::table('category')
        ->select()
        ->orderBy('id', 'desc')
        ->get();
        
        return view('category/index', ["categoryData" => $categoryData]);
    }

    public function create(Request $request){

        $result = DB::table('category')->insert([
            'name' => $request->input('name'),
            'created_date' => date('Y-m-d')
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to save data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully saved."]);
    }

    public function fetch_data(Request $request) {

        $result = DB::table('category')
        ->select()
        ->where('id', $request->input('id'))
        ->get();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to fetch data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully fetching data.", "data" => $result]);
    }

    public function update(Request $request) {
        $result = DB::table('category')
        ->where('id', $request->input('id'))
        ->update([
            'name' => $request->input('name'),
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to update data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully updated."]);
    }

    public function delete(Request $request) {
        $result = DB::table('category')
        ->where('id', $request->input('id'))
        ->delete();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to delete data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully deleted."]);
    }
}
