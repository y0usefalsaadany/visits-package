<?php

use Illuminate\Support\Facades\Route;
use Yousef\Visits\Http\Controllers\VisitController;
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

Route::get('/visits-package', function () {
    return view('visits::visits');
});

Route::post('data',[VisitController::class,'index']);