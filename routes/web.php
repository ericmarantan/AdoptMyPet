<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//admin
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get','post'],'login','AdminController@login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::match(['get','post'],'update-password', 'AdminController@updatePassword');
        Route::match(['get','post'],'update-details', 'AdminController@updateDetails');
        Route::match(['get','post'],'register-account', 'AdminController@registerAccount');
        Route::post('check-current-password','AdminController@checkCurrentPassword'); 
        Route::get('logout','AdminController@logout');
        Route::get('manage-account','AdminController@accountList');

        Route::get('manage-orders','AdminController@manageOrder');
        Route::get('manage-invoices','AdminController@manageInvoice');

        Route::post('destroy-user','AdminController@deleteUser');

        Route::get('viewDetails', 'AdminController@viewAccountDetails');
        Route::get('viewOrder', 'AdminController@viewOrderDetails');

        Route::post('updateStat', 'AdminController@updateStatus');
        Route::post('deleteOrder', 'AdminController@deleteOrder');
    });
        
});

//organization
Route::prefix('/adopter')->namespace('App\Http\Controllers\Adopter')->group(function () {
    Route::match(['get','post'],'login','AdopterController@login');
    Route::group(['middleware' => ['adopter']], function () {
        Route::get('dashboard', 'AdopterController@dashboard');
        Route::match(['get','post'],'update-password', 'AdopterController@updatePassword');
        Route::get('logout','AdopterController@logout');
        Route::match(['get','post'],'update-details', 'AdopterController@updateDetails');
        Route::post('update-details-account','AdopterController@updateDetailsAccount');
        Route::post('check-current-password','AdopterController@checkCurrentPassword');
        Route::post('updatePassbok','AdopterController@updatePassbok');
        Route::post('update-address','AdopterController@updateAddress');
        //Route::match(['get','post'],'register','AdopterController@registerAdopter'); 
        //Route::post('order-new-tag','AdopterController@orderNewTag');
        Route::get('order-new-tag','AdopterController@orderNewTag');
        Route::get('manage-orders','AdopterController@manageOrder');
        Route::get('check-price','AdopterController@checkPrice');
        //Route::post('order-process','OrderController@orderSubmit');
        Route::post('order-process','AdopterController@orderSubmit');
        Route::get('view-details', 'AdopterController@orderDetails');
    });    
    
});

//orders
// Route::prefix('/order')->namespace('App\Http\Controllers\Order')->group(function () {
//     Route::group(['middleware' => ['order']], function () {
//         Route::post('order-process','OrderController@orderSubmit');
//     });    
    
// });