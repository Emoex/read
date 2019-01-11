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



Route::resource('/admin/user','admin\UserController');
Route::resource('/admin/ting','admin\TingController');
Route::resource('/admin/blogroll','admin\BlogrollController');
Route::resource('/home/ting','home\TingController');
Route::resource('/home/index','home\IndexController');






Route::get('/admin/login','admin\LoginController@index');
Route::post('/admin/doLogin','admin\LoginController@doLogin');
Route::get('/admin/logout','admin\LoginController@Logout');
Route::resource('/admin/admin','admin\AdminController')->middleware('App\Http\Middleware\CheckLogin::class');
Route::get('/admin/showSetPassword/{id}','admin\AdminController@showSetPassword');
Route::post('/admin/setPassword/{id}','admin\AdminController@setPassword');
Route::resource('/admin/cate','admin\CateController')->middleware('App\Http\Middleware\CheckLogin::class');
Route::resource('/admin/article','admin\ArticleController')->middleware('App\Http\Middleware\CheckLogin::class');
Route::resource('/admin/report','admin\ReportController')->middleware('App\Http\Middleware\CheckLogin::class');
Route::get('/home/article/cate/{id}','home\ArticleController@showCate');
Route::post('/home/article/pinterest','home\ArticleController@pinterest');
Route::resource('/home/article/comment','home\ArticleCommentController');
Route::post('/home/article/look','home\ArticleController@look');
Route::post('/home/article/like','home\ArticleController@like');
Route::resource('/home/article','home\ArticleController');
Route::get('/home/login/code','home\LoginController@sendMobileCode');
Route::resource('/home/login','home\LoginController');
Route::post('/home/doLogin','home\LoginController@doLogin');
Route::get('/home/logout','home\LoginController@logout');
Route::get('/home/userinfo/showSetPassword','home\UserinfoController@showSetPassword');
Route::post('/home/userinfo/setPassword','home\UserinfoController@setPassword');
Route::resource('/home/userinfo','home\UserinfoController');
Route::resource('/home/personal','home\PersonalController');
Route::post('/home/personal/pinterest','home\PersonalController@pinterest');
Route::resource('/home/report','home\ReportController');
Route::resource('/home/feed','home\FeedController');
Route::resource('/home/follow','home\FollowController');












Route::resource('admin/Conf/Slide','admin\SlideController');
Route::post('admin/Conf/title_update','admin\ConfController@title_update');//标题管理
Route::post('admin/Conf/Logo_update','admin\ConfController@Logo_update');//网站Logo管理
Route::resource('admin/Conf','admin\ConfController');//网站管理
Route::resource('admin/timeline','admin\TimelineController');//后台碎片管理
Route::post('admin/timeline/profile','admin\TimelineController@profile');//碎片图片上传
Route::get('home/timeline/like','home\TimelineController@like');//点击喜欢
Route::get('home/timeline/huifu','home\TimelineCommentController@huifu');//前台碎片回复
Route::resource('home/timeline','home\TimelineController');//前台碎片管理
Route::resource('home/timeline/comment','home\TimelineCommentController');//前台碎片评论



