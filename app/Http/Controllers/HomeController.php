<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class HomeController extends Controller
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
        
        return view('admin/home', ["expensesData" => $expensesData, "categoryData" => $categoryData]);
    }
}
