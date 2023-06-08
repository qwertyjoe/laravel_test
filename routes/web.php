<?php

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

Route::get('/',"App\Http\Controllers\Controller@direct_user" );

Route::get('/register', function () {
    
    return view('register');
});

Route::post('/register',"App\Http\Controllers\\register@register");

Route::post('/home', "App\Http\Controllers\login@login");
Route::get('/home',"App\Http\Controllers\Controller@check_login");

Route::get('/video/{video_name}',"App\Http\Controllers\\video_page_controller@request_video");
Route::get('/file/{file_name}',"App\Http\Controllers\\file_controller@video_feed");



