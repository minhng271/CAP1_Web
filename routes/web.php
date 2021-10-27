<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

// TEST
Route::get('test', 'TestController@todayList');
Route::get('test/tiem-hom-nay', 'TestController@todayList')->name('today-list');
Route::get('test/danh-sach-cho', 'TestController@waitList');
Route::get('test/done-patient/{id}', 'TestController@done_patient');
Route::get('test/delete-patient/{id}', 'TestController@delete_patient');
Route::post('test/result', 'TestController@result');

Route::get('test/danh-sach-theo-lich', 'TestController@list_to_calander');

// VACCINE
Route::get('vaccine', 'VaccineController@todayList');
Route::get('vaccine/tiem-hom-nay', 'VaccineController@todayList')->name('today-list');
Route::get('vaccine/danh-sach-cho', 'VaccineController@waitList');
Route::get('vaccine/done-patient/{id}', 'VaccineController@done_vaccine');
Route::get('vaccine/delete-patient/{id}', 'VaccineController@delete_vaccine');
Route::post('vaccine/result', 'VaccineController@result');

Route::get('vaccine/danh-sach-theo-lich', 'VaccineController@list_to_calander');
});

Route::middleware(['auth', 'is_admin'])->group(function () {


// ADMIN HOSPITAL
Route::get('admin/hospitals', 'AdminController@hospitals');
Route::get('admin/hospital/add', 'AdminController@add_hospitals');
Route::post('admin/hospital/store', 'AdminController@store_add_hospitals');
Route::get('admin/hospital/delete/{id}', 'AdminController@delete_hospitals');
Route::get('admin/hospital/edit/{id}', 'AdminController@edit_hospitals');
Route::post('admin/hospital/store/edit', 'AdminController@store_edit_hospitals');
Route::get('admin/hospital/bin', 'AdminController@bin_hospitals');
Route::get('admin/hospital/restore/{id}', 'AdminController@restore_hospitals');


// ADMIN USERS
Route::get('admin/users', 'AdminController@users');
Route::get('admin/user/add', 'AdminController@add_users');
Route::post('admin/user/store', 'AdminController@store_add_users');
Route::get('admin/user/delete/{id}', 'AdminController@delete_users');
Route::get('admin/user/edit/{id}', 'AdminController@edit_users');
Route::post('admin/user/store/edit', 'AdminController@store_edit_users');
Route::get('admin/user/bin', 'AdminController@bin_users');
Route::get('admin/user/restore/{id}', 'AdminController@restore_users');
});