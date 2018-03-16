<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',"Home\IndexController@getIndex");

Route::get('auth/login', 'Auth\AuthController@login');
Route::get('auth/add', 'Auth\AuthController@add');
Route::post('auth/reg', 'Auth\AuthController@reg');
Route::post('auth/login', 'Auth\AuthController@doLogin');
Route::get('auth/logout', 'Auth\AuthController@logOut');


Route::group(['middleware'=>'auth'],function(){
	Route::controller('admin/index',"Admin\IndexController");
	Route::controller('admin/banner',"Admin\BannerController");
	Route::controller('admin/banner1',"Admin\Banner1Controller");
	Route::controller('admin/lastbanner',"Admin\LastbannerController");
	Route::controller('admin/user',"Admin\UserController");
	Route::controller('admin/permission',"Admin\PermissionController");
	Route::controller('admin/role',"Admin\RoleController");
	Route::controller('admin/category',"Admin\CategoryController");
	Route::controller('admin/provice',"Admin\ProviceController");
	Route::controller('admin/pdo',"Admin\PdoController");
	Route::controller('admin/pdo_type',"Admin\Pdo_typeController");
	Route::controller('admin/pdo_attr',"Admin\Pdo_attrController");
	Route::controller('admin/pdo_image',"Admin\Pdo_imageController");
	Route::controller('admin/vip',"Admin\VipController");
	Route::controller('admin/vipical',"Admin\VipicalController");
	Route::controller('admin/cart',"Admin\CartController");
	Route::controller('admin/indent',"Admin\IndentController");

	Route::controller('admin/fourpic',"Admin\FourpicController");
	Route::controller('admin/cate_image',"Admin\Cate_imageController");
	Route::controller('admin/viptalk',"Admin\ViptalkController");
	Route::controller('admin/dian',"Admin\DianController");

	
});
Route::controller('home/index',"Home\IndexController");
Route::controller('home/login','Home\LoginController');
Route::controller('home/show','Home\ShowController');
Route::controller('home/list','Home\ListController');
Route::controller('home/shop','Home\ShopController');
Route::controller('home/personal','Home\PersonalController');
Route::controller('home/dian','Home\DianController');
Route::controller('home/nsyj','Home\NsyjController');

Route::get('mail/send','MailController@send');
Route::get('mail/sms','MailController@sms');
Route::get('mail/yan','MailController@yan');
Route::get('mail/yan','MailController@yan');
Route::controller('img','ImageController');
// Route::controller('insert','ImageController');

// Route::controller('admin/banner',"Admin\BannerController");
