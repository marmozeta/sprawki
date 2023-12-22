<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\MenuController;

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
    return redirect()->to('admin');
});

Route::namespace('App\Http\Controllers\Admin')->group(function () { 
    Route::get('/admin/login', 'LoginController@show')->name('admin.login');
    Route::post('/admin/login', 'LoginController@login')->name('admin.login.perform');
    
    Route::get('/admin/logout', 'LoginController@logout')->name('logout.perform');  
    
    Route::get('admin', 'DashboardController@index')->name('admin.dashboard')->middleware('auth'); 
    //menu
    Route::get('admin/menu', 'MenuController@index')->name('admin.menu')->middleware('auth'); 
    Route::get('admin/menu/create', 'MenuController@create')->name('admin.forms.menu')->middleware('auth'); 
    Route::post('admin/menu/store', 'MenuController@store')->name('admin.forms.menu.store')->middleware('auth'); 
    Route::post('admin/menu/update/{id}', 'MenuController@update')->name('admin.forms.menu.update')->middleware('auth'); 
    Route::get('admin/menu/edit/{id}', 'MenuController@edit')->name('admin.forms.menu.edit')->middleware('auth'); 
    Route::get('admin/menu/remove/{id}', 'MenuController@remove')->name('admin.forms.menu.remove')->middleware('auth'); 
    
    //kategorie
    Route::get('admin/category', 'CategoryController@index')->name('admin.category')->middleware('auth'); 
    Route::get('admin/category/create', 'CategoryController@create')->name('admin.forms.category')->middleware('auth'); 
    Route::post('admin/category/store', 'CategoryController@store')->name('admin.forms.category.store')->middleware('auth'); 
    Route::post('admin/category/update/{id}', 'CategoryController@update')->name('admin.forms.category.update')->middleware('auth'); 
    Route::get('admin/category/edit/{id}', 'CategoryController@edit')->name('admin.forms.category.edit')->middleware('auth'); 
    Route::get('admin/category/remove/{id}', 'CategoryController@remove')->name('admin.forms.category.remove')->middleware('auth'); 
    
    //typy
    Route::get('admin/type', 'TypeController@index')->name('admin.type')->middleware('auth'); 
    Route::get('admin/type/create', 'TypeController@create')->name('admin.forms.type')->middleware('auth'); 
    Route::post('admin/type/store', 'TypeController@store')->name('admin.forms.type.store')->middleware('auth'); 
    Route::post('admin/type/update/{id}', 'TypeController@update')->name('admin.forms.type.update')->middleware('auth'); 
    Route::get('admin/type/edit/{id}', 'TypeController@edit')->name('admin.forms.type.edit')->middleware('auth'); 
    Route::get('admin/type/remove/{id}', 'TypeController@remove')->name('admin.forms.type.remove')->middleware('auth'); 
    
    //elementy
    Route::get('admin/element/{slug}', 'ElementController@index')->name('admin.element')->middleware('auth'); 
    Route::get('admin/element/create/{slug}', 'ElementController@create')->name('admin.forms.element')->middleware('auth'); 
    Route::post('admin/element/store/{slug}', 'ElementController@store')->name('admin.forms.element.store')->middleware('auth'); 
    Route::post('admin/element/update/{slug}/{id}', 'ElementController@update')->name('admin.forms.element.update')->middleware('auth'); 
    Route::get('admin/element/edit/{slug}/{id}', 'ElementController@edit')->name('admin.forms.element.edit')->middleware('auth'); 
    Route::get('admin/element/remove/{slug}/{id}', 'ElementController@remove')->name('admin.forms.element.remove')->middleware('auth'); 

    //użytkownicy
    Route::get('admin/user', 'UserController@index')->name('admin.user')->middleware('auth'); 
    Route::get('admin/user/create', 'UserController@create')->name('admin.forms.user')->middleware('auth'); 
    Route::post('admin/user/store', 'UserController@store')->name('admin.forms.user.store')->middleware('auth'); 
    Route::post('admin/user/update/{id}', 'UserController@update')->name('admin.forms.user.update')->middleware('auth'); 
    Route::get('admin/user/edit/{id}', 'UserController@edit')->name('admin.forms.user.edit')->middleware('auth'); 
    Route::get('admin/user/remove/{id}', 'UserController@remove')->name('admin.forms.user.remove')->middleware('auth'); 
 
    //komentarze
    Route::get('admin/comment', 'CommentController@index')->name('admin.comment')->middleware('auth'); 
    Route::get('admin/comment/create', 'CommentController@create')->name('admin.forms.comment')->middleware('auth'); 
    Route::post('admin/comment/store', 'CommentController@store')->name('admin.forms.comment.store')->middleware('auth'); 
    Route::post('admin/comment/update/{id}', 'CommentController@update')->name('admin.forms.comment.update')->middleware('auth'); 
    Route::get('admin/comment/edit/{id}', 'CommentController@edit')->name('admin.forms.comment.edit')->middleware('auth'); 
    Route::get('admin/comment/remove/{id}', 'CommentController@remove')->name('admin.forms.comment.remove')->middleware('auth'); 
        
    //zamówienia
    Route::get('admin/order', 'OrderController@index')->name('admin.order')->middleware('auth'); 
    Route::get('admin/order/create', 'OrderController@create')->name('admin.forms.order')->middleware('auth'); 
    Route::post('admin/order/store', 'OrderController@store')->name('admin.forms.order.store')->middleware('auth'); 
    Route::post('admin/order/update/{id}', 'OrderController@update')->name('admin.forms.order.update')->middleware('auth'); 
    Route::get('admin/order/edit/{id}', 'OrderController@edit')->name('admin.forms.order.edit')->middleware('auth'); 
    Route::get('admin/order/remove/{id}', 'OrderController@remove')->name('admin.forms.order.remove')->middleware('auth'); 
        
    //reklamy
    Route::get('admin/ad', 'AdController@index')->name('admin.ad')->middleware('auth'); 
    Route::get('admin/ad/create', 'AdController@create')->name('admin.forms.ad')->middleware('auth'); 
    Route::post('admin/ad/store', 'AdController@store')->name('admin.forms.ad.store')->middleware('auth'); 
    Route::post('admin/ad/update/{id}', 'AdController@update')->name('admin.forms.ad.update')->middleware('auth'); 
    Route::get('admin/ad/edit/{id}', 'AdController@edit')->name('admin.forms.ad.edit')->middleware('auth'); 
    Route::get('admin/ad/remove/{id}', 'AdController@remove')->name('admin.forms.ad.remove')->middleware('auth'); 
    
    
});