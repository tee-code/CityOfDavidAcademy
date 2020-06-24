<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');


Route::get('/ckeditor', 'CkeditorController@index');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/profile/{id}', 'ProfileController@show')->name('profile');
Route::get('/dashboard/users', 'UsersController@index');
Route::get('/dashboard/sections', 'SectionsController@index');
Route::get('/dashboard/classes', 'ClassesController@index');
Route::get('/dashboard/fees', 'FeesController@index');
Route::get('/dashboard/notifications', 'NotificationController@index');
Route::get('/dashboard/expenses', 'ExpensesController@index');
Route::get('/dashboard/allowances', 'AllowancesController@index');
Route::get('/dashboard/debtors', 'DebtorsController@index');
Route::get('/dashboard/discounts', 'DiscountsController@index');
Route::get('/dashboard/staffs', 'StaffsController@index');
Route::get('/dashboard/schoolfees', 'SchoolFeesController@index');
Route::get('/dashboard/students', 'StudentsController@index');
Route::get('/dashboard/taxes', 'TaxesController@index');
Route::resource('dashboard','DashboardController');
Route::resource('users','UsersController');
Route::resource('profile','ProfileController');
Route::resource('password','PasswordController');
Route::resource('sections','SectionsController');
Route::resource('classes','ClassesController');
Route::resource('fees','FeesController');
Route::resource('notification','NotificationController');
Route::resource('expenses','ExpensesController');
Route::resource('allowances', 'AllowancesController');
Route::resource('debtors', 'DebtorsController');
Route::resource('discounts', 'DiscountsController');
Route::resource('staffs', 'StaffsController');
Route::resource('schoolfees', 'SchoolFeesController');
Route::resource('students', 'StudentsController');
Route::resource('taxes', 'TaxesController');



Auth::routes();

