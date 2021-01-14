<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PatientController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('home');    });
    
Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('admin.clinic');    });
        
        Route::resource('clinic', ClinicController::class);
        Route::post('clinic/update/{clinic}', [ClinicController::class,'update'])->name('sample.update');
        Route::get('clinic/destroy/{id}', [ClinicController::class,'destroy']);
        Route::resource('patient', PatientController::class);
        Route::post('patient/updatepatient', [PatientController::class,'update']);
        Route::get('patient/delete', [PatientController::class,'destroy']);

        Route::get('findpatient', [PatientController::class,'findpatient']);
        Route::resource('order', OrderController::class);
        


});

Route::get('/', function () {
    return view('home');    });
    
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
