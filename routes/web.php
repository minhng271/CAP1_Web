<?php

use App\Http\Controllers\TestController;
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
Auth::routes();
// LOGIN
Route::get('/', function () {
    return view('auth.login');
});

Route::post('getLogin', 'UserController@getLogin')->name('getLogin');

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {

// TEST
Route::get('dashboard/test','TestController@dashboard');
Route::get('test/xet-nghiem-hom-nay', 'TestController@todayList');
Route::get('test/danh-sach-xoa-tam', 'TestController@softDeleteList');
Route::get('test/danh-sach-cho', 'TestController@waitList');
Route::get('test/done-patient/{id_card}', 'TestController@done_patient');
Route::get('test/restore-patient/{id_card}', 'TestController@restore_patient');
Route::get('test/delete-patient/{id_card}', 'TestController@delete_patient');
Route::get('test/delete-patient-softDelete/{id_card}', 'TestController@delete_patient_softDelete');
Route::post('test/result', 'TestController@result');
Route::get('test/danh-sach-theo-lich', 'TestController@list_to_calander');

// VACCINE
Route::get('dashboard/vaccine','VaccineController@dashboard');
Route::get('vaccine/danh-sach-vaccine','VaccineController@vaccine_list');
Route::get('vaccine/edit-vaccine/{id}','VaccineController@edit_vaccine');
Route::post('vaccine/store-edit-vaccine','VaccineController@store_edit_vaccine');
Route::get('vaccine/delete-vaccine/{id}','VaccineController@delete_vaccine');
Route::get('vaccine/danh-sach-vaccine-da-xoa','VaccineController@bin_vaccine');
Route::get('vaccine/khoi-phuc-vaccine/{id}','VaccineController@restore_bin_vaccine');
Route::get('vaccine/them-moi-vaccine','VaccineController@vaccine_addnew');
Route::post('vaccine/store-addnew-vaccine','VaccineController@store_addnew');
Route::get('vaccine/nhap-them-vaccine','VaccineController@vaccine_import');
Route::get('vaccine/store-them-sl-vaccine','VaccineController@store_vaccine_import');

// danh sach 
Route::get('vaccine', 'VaccineController@todayList');
Route::get('vaccine/tiem-hom-nay', 'VaccineController@todayList');
Route::post('vaccine/confirm-vaccine/{id_card}', 'VaccineController@confirm_vaccine');
Route::get('vaccine/delete-patient/{id_card}', 'VaccineController@delete_patient_vaccine');
Route::get('vaccine/danh-sach-cho', 'VaccineController@waitList');
Route::get('vaccine/restore-patient/{id_card}', 'VaccineController@restorePatient');
Route::post('vaccine/result', 'VaccineController@result');

Route::get('vaccine/danh-sach-theo-lich', 'VaccineController@list_to_calander');
});

Route::middleware(['auth', 'is_admin'])->group(function () {


// ADMIN HOSPITAL
Route::get('dashboard/admin','AdminController@dashboard');
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



Route::get('dashboard', function(){
    return view('dashboard');
});

Route::get('them-vaccine', function(){
    return view('them_vaccine');
});

Route::get('them-sl-vaccine', function(){
    return view('nhap_sl_vaccine');
});