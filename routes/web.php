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

Route::group(['prefix' => '/login'], function() {
    // user login
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginRegisterManager@login_page']);
    Route::post('/login', ['as' => 'login:action', 'uses' => 'LoginRegisterManager@login_action']);


    //user registration
    Route::get('/register', ['as' => 'register:page', 'uses' => 'LoginRegisterManager@register_page']);
    Route::post('/register', ['as' => 'register:action', 'uses' => 'LoginRegisterManager@register_action']);


    //user logut
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginRegisterManager@logout']);
});

Route::group(['prefix' => '/home', 'middleware' => 'auth'], function() {
    Route::get('/', ['as' => 'user:home', 'uses' => 'HomeController@home']);
});

//user's gift list
Route::group(['prefix' => '/userlist', 'middleware' => 'auth'], function() {

    Route::get('/', ['as' => 'list:show', 'uses' => 'GiftListController@home']);
    
    Route::get('/add/{id}', ['as' => 'list:manage', 'uses' => 'GiftListController@manage_list']);
    Route::post('/add', ['as' => 'list:new', 'uses' => 'GiftListController@add_list']);

    Route::post('/add/item', ['as' => 'list:add_item', 'uses' => 'GiftListController@insert_item']);
    Route::post('/add/guest', ['as' => 'list:add_guest', 'uses' => 'GiftListController@add_guest']);

    Route::post('/delete/list', ['as' => 'list:delete', 'uses' => 'GiftListController@delete_list']);
    Route::post('/delete/item', ['as' => 'list:remove_item',
        'uses' => 'GiftListController@delete_item']);

    Route::post('/delete/guest', ['as' => 'list:remove_guest', 
        'uses' => 'GiftListController@remove_guest']);


    Route::get('/guest', ['as' => 'list:guest', 'uses' => 'GiftListController@show_guest_list']);
    Route::post('/guest/unsubscribe', ['as' => 'list:unsubscribe', 'uses' => 'GiftListController@unsubscribe_from_list']);
    Route::post('/guestonly', ['as' => 'list:guest_only', 'uses' => 'GiftListController@update_guest_only']);

    Route::get('/old/{id}', ['as' => 'list:old', 'uses' => 'GiftListController@old']);

    Route::post('/recipient/add', ['as' => 'list:recipient', 'uses' => 'GiftListController@recipient']);
    Route::post('/recipient/delete', ['as' => 'list:recipient_delete', 'uses' => 'GiftListController@recipient_delete']);

});


// purchase managment
Route::group(['prefix' => '/purchase', 'middleware' => 'auth'], function () {
    Route::get('/list', ['as' => 'purchase:list', 'uses' => 'PurchaseController@list']);
    Route::get('/list/{id}', ['as' => 'purchase:info', 'uses' => 'PurchaseController@info']);
    Route::post('/make', ['as' => 'purchase:make', 'uses' => 'PurchaseController@purchase']);


    Route::post('/delete', ['as' => 'purchase:delete', 'uses' => 'PurchaseController@delete_purchase']);
    Route::post('/void', ['as' => 'purchase:void', 'uses' => 'PurchaseController@void_purchase']);

    Route::post('/auto', ['as' => 'purchase:automatic', 'uses' => 'PurchaseController@automatic_purchase']);

});

// debt managment
Route::group(['prefix' => '/debt', 'middleware' => 'auth'], function () {
    Route::get('/list', ['as' => 'debt:list', 'uses' => 'DebtController@list']);
    Route::post('/settle', ['as' => 'debt:settle', 'uses' => 'DebtController@settle']);
    Route::post('/settle/refuse', 
        ['as' => 'debt:refuse', 'uses' => 'DebtController@refuse_settle']);

    Route::get('/nofication', 
        ['as' => 'debt:notification', 'uses' => 'DebtController@list_notifications']);


    Route::post('/nofication/mark', 
        ['as' => 'debt:mark', 'uses' => 'DebtController@mark_as_seen']);

});


//poll managment
Route::group(['prefix' => '/poll', 'middleware' => 'auth'], function ()  {
    Route::post('/toggle', ['as' => 'vote:toggle_mode', 'uses' => 'PollManager@toggle_poll_mode']);
    Route::post('/vote', ['as' => 'vote:vote', 'uses' => 'PollManager@vote']);
    Route::post('/clear', ['as' => 'vote:clear', 'uses' => 'PollManager@clear_votes']);
});


//user settings 
Route::group(['prefix' => '/user/settings', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'settings:index', 'uses' => 'SettingsController@index']);
    
    Route::post('/profile/picture/set', ['as' => 'settings:set-profile-pic', 'uses' => 'ProfilePictureController@set_profile_pic']);
    Route::post('/profile/picture/delete', ['as' => 'settings:del-profile-pic', 'uses' => 'ProfilePictureController@delete_profile_pic']);

    Route::post('/password/reset', ['as' => 'settings:reset', 'uses' => 'ResetPasswordController@reset_password']);

});

//item settings 
Route::group(['prefix' => '/item/settings', 'middleware' => 'auth'], function() {
    Route::post('/index', ['as' => 'item-settings:index', 'uses' => 'ItemSettingsController@index']);
    Route::post('/set/price', ['as' => 'item-settings:update-price', 'uses' => 'ItemSettingsController@update_price']);
});



Route::redirect('/', route('user:home'));
