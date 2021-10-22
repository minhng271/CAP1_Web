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

// VACCINE
Route::get('vaccine', 'VaccineController@todayList');
});