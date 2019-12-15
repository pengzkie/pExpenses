<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Expenses;
use Session;

class ExpensesController extends Controller
{
    public function index(){

        if(!Session::exists('userid')){
            return redirect('login');
        }

        $categoryData = DB::table('category')
        ->select()
        ->orderBy('id', 'desc')
        ->get();

        $expensesData = DB::table('expenses')
        ->select('expenses.*', 'category.name as category_name')
        ->join('category', 'expenses.category_id', '=', 'category.id')
        ->orderBy('expenses.id', 'desc')
        ->where('expenses.users_id', Session::get('userid'))
        ->get();
        
        return view('expenses/index', ["expensesData" => $expensesData, "categoryData" => $categoryData]);
    }

    public function create(Request $request){

        $result = DB::table('expenses')->insert([
            'amount' => $request->input('amount'),
            'category_id' => $request->input('category_id'),
            'users_id' => Session::get('userid'),
            'created_date' => date('Y-m-d')
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to save data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully saved."]);
    }

    public function fetch_data(Request $request) {

        $result = DB::table('expenses')
        ->select('expenses.*', 'category.id as category_id')
        ->join('category', 'expenses.category_id', '=', 'category.id')
        ->where('expenses.id', $request->input('id'))
        ->get();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to fetch data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully fetching data.", "data" => $result]);
    }

    public function update(Request $request) {
        $result = DB::table('expenses')
        ->where('id', $request->input('id'))
        ->update([
            'amount' => $request->input('amount'),
            'category_id' => $request->input('category_id'),
        ]);

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to update data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully updated."]);
    }

    public function delete(Request $request) {
        $result = DB::table('expenses')
        ->where('id', $request->input('id'))
        ->delete();

        if(!$result){
            return response()->json(["code" => "99", "message" => "Failed to delete data."]);
        }
        
        return response()->json(["code" => "00", "message" => "Successfully deleted."]);
    }
}
