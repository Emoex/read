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

Route::get('/', function () {
    return view('welcome');
});











































Route::resource('admin/Conf/Slide','admin\SlideController');
Route::post('admin/Conf/title_update','admin\ConfController@title_update');//标题管理
Route::post('admin/Conf/Logo_update','admin\ConfController@Logo_update');//网站Logo管理
Route::resource('admin/Conf','admin\ConfController');//网站管理
Route::resource('admin/timeline','admin\TimelineController');//后台碎片管理
Route::post('admin/timeline/profile','admin\TimelineController@profile');//碎片图片上传
Route::resource('home/timeline','home\TimelineController');//前台碎片管理

