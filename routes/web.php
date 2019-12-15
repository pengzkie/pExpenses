<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login Form
Route::get('/', 'LoginController@index');
Route::get('/login', 'LoginController@index');
Route::post('/login/fetch_data/', 'LoginController@fetch_data');

// Register Form
Route::get('/register', function () {
    return view('register');
});

// Home
Route::get('/home', 'HomeController@index');

// Update password
Route::get('/password', 'PasswordController@index');
Route::post('/password/update', 'PasswordController@update');

// User
Route::get('/user', 'UserController@index');
Route::post('/user/add', 'UserController@create');
Route::post('/user/fetch_data/', 'UserController@fetch_data');
Route::post('/user/delete', 'UserController@delete');
Route::post('/user/update', 'UserController@update');

// Role
Route::get('/role', 'RoleController@index');
Route::post('/role/add', 'RoleController@create');
Route::post('/role/fetch_data/', 'RoleController@fetch_data');
Route::post('/role/delete', 'RoleController@delete');
Route::post('/role/update', 'RoleController@update');

// Category
Route::get('/category', 'CategoryController@index');
Route::post('/category/add', 'CategoryController@create');
Route::post('/category/fetch_data/', 'CategoryController@fetch_data');
Route::post('/category/delete', 'CategoryController@delete');
Route::post('/category/update', 'CategoryController@update');

// Expenses
Route::get('/expenses', 'ExpensesController@index');
Route::post('/expenses/add', 'ExpensesController@create');
Route::post('/expenses/fetch_data/', 'ExpensesController@fetch_data');
Route::post('/expenses/delete', 'ExpensesController@delete');
Route::post('/expenses/update', 'ExpensesController@update');