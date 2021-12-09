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
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::middleware(['auth', 'is_test'])->group(function () {
// TEST
Route::get('dashboard/test','TestController@dashboard');
Route::get('test/limit','TestController@limit');
Route::get('test/limit/edit','TestController@edit_limit');
Route::post('test/limit/store_edit','TestController@store_edit_limit');

Route::get('test/profile','TestController@profile');
Route::get('test/profile/edit','TestController@edit_profile');
Route::post('test/profile/store-edit','TestController@store_edit_profile');

Route::get('test/xet-nghiem-hom-nay', 'TestController@todayList');
Route::get('test/danh-sach-xoa-tam', 'TestController@softDeleteList');
Route::get('test/danh-sach-cho', 'TestController@waitList');
Route::get('test/done-patient/{id_card}', 'TestController@done_patient');
Route::get('test/restore-patient/{id_card}', 'TestController@restore_patient');
Route::get('test/delete-patient/{id_card}', 'TestController@delete_patient');
Route::get('test/delete-patient-softDelete/{id_card}', 'TestController@delete_patient_softDelete');
Route::post('test/result', 'TestController@result');
Route::get('test/danh-sach-theo-lich', 'TestController@list_to_calander');

});

Route::middleware(['auth','is_vaccine'])->group(function () {
// VACCINE
Route::get('dashboard/vaccine','VaccineController@dashboard');
Route::get('vaccine/limit','VaccineController@limit');
Route::get('vaccine/limit/edit','VaccineController@edit_limit');
Route::post('vaccine/limit/store_edit','VaccineController@store_edit_limit');

Route::get('vaccine/profile','VaccineController@profile');
Route::get('vaccine/profile/edit','VaccineController@edit_profile');
Route::post('vaccine/profile/store-edit','VaccineController@store_edit_profile');

Route::get('vaccine/danh-sach-vaccine','VaccineController@vaccine_list');
Route::get('vaccine/edit-vaccine/{id}','VaccineController@edit_vaccine');
Route::post('vaccine/store-edit-vaccine','VaccineController@store_edit_vaccine');
Route::get('vaccine/delete-vaccine/{id}','VaccineController@delete_vaccine');
Route::get('vaccine/delete-vaccine-bin/{id}','VaccineController@delete_vaccine_bin');
Route::get('vaccine/danh-sach-vaccine-da-xoa','VaccineController@bin_vaccine');
Route::get('vaccine/khoi-phuc-vaccine/{id}','VaccineController@restore_bin_vaccine');
Route::get('vaccine/them-moi-vaccine','VaccineController@vaccine_addnew');
Route::post('vaccine/store-addnew-vaccine','VaccineController@store_addnew');
Route::get('vaccine/nhap-them-vaccine','VaccineController@vaccine_import');
Route::get('vaccine/store-them-sl-vaccine','VaccineController@store_vaccine_import');

// loai benh
Route::get('vaccine/danh-sach-loai-benh','VaccineController@disease_list');
Route::get('vaccine/edit-disease/{id}','VaccineController@edit_disease');
Route::post('vaccine/store-edit-disease/{id}','VaccineController@store_edit_disease');
Route::get('vaccine/delete-disease/{id}','VaccineController@delete_disease');
Route::get('vaccine/danh-sach-loai-benh-da-xoa','VaccineController@bin_disease');
Route::get('vaccine/delete-disease-bin/{id}','VaccineController@delete_disease_bin');
Route::get('vaccine/restore-disease/{id}','VaccineController@restore_bin_disease');
Route::get('vaccine/them-moi-loai-benh','VaccineController@disease_addnew');
Route::post('vaccine/store-addnew-disease','VaccineController@store_addnew_disease');

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

    // ADMIN HOSPITAL ACCOUNT
Route::get('dashboard/admin','AdminController@dashboard');
Route::get('admin/hospital-acc', 'AdminController@hospitals');
Route::get('admin/hospital-acc/add', 'AdminController@add_hospitals');
Route::post('admin/hospital-acc/store', 'AdminController@store_add_hospitals');
Route::get('admin/hospital-acc/delete/{id}', 'AdminController@delete_hospitals');
Route::get('admin/hospital-acc/delete-bin/{id}', 'AdminController@delete_hospitals_bin');
Route::get('admin/hospital-acc/edit/{id}', 'AdminController@edit_hospitals');
Route::post('admin/hospital-acc/store/edit', 'AdminController@store_edit_hospitals');
Route::get('admin/hospital-acc/bin', 'AdminController@bin_hospitals');
Route::get('admin/hospital-acc/restore/{id}', 'AdminController@restore_hospitals');

    // ADMIN HOSPITAL
Route::get('admin/hospital', 'AdminController@list_hos');
Route::get('admin/hospital/add', 'AdminController@add_hos');
Route::post('admin/hospital/store', 'AdminController@store_add_hos');
Route::get('admin/hospital/delete/{id}', 'AdminController@delete_hos');
Route::get('admin/hospital/delete-bin/{id}', 'AdminController@delete_hos_bin');
Route::get('admin/hospital/edit/{id}', 'AdminController@edit_hos');
Route::post('admin/hospital/store/edit', 'AdminController@store_edit_hos');
Route::get('admin/hospital/bin', 'AdminController@bin_hos');
Route::get('admin/hospital/restore/{id}', 'AdminController@restore_hos');



// ADMIN USERS
Route::get('admin/users', 'AdminController@users');
Route::get('admin/user/add', 'AdminController@add_users');
Route::post('admin/user/store', 'AdminController@store_add_users');
Route::get('admin/user/delete/{id}', 'AdminController@delete_users');
Route::get('admin/user/delete_user_bin/{id}', 'AdminController@delete_user_bin');
Route::get('admin/user/edit/{id_card}', 'AdminController@edit_users');
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
