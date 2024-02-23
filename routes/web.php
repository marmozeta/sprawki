<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\MenuController;
use App\Models\Menu;
use App\Models\User;

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

Route::namespace('App\Http\Controllers\Admin')->group(function () { 
    
    Route::get('/admin/login', 'LoginController@show')->name('admin.login');
    Route::post('/admin/login', 'LoginController@login')->name('admin.login.perform');
    Route::get('/admin/logout', 'LoginController@logout')->name('admin.logout.perform');  
    
    Route::get('admin', 'DashboardController@index')->name('admin.dashboard')->middleware('auth'); 
    
    //menu
    Route::get('admin/menu', 'MenuController@index')->name('admin.menu')->middleware('auth'); 
    Route::get('admin/menu/create', 'MenuController@create')->name('admin.forms.menu')->middleware('auth'); 
    Route::post('admin/menu/store', 'MenuController@store')->name('admin.forms.menu.store')->middleware('auth'); 
    Route::post('admin/menu/update/{id}', 'MenuController@update')->name('admin.forms.menu.update')->middleware('auth'); 
    Route::get('admin/menu/edit/{id}', 'MenuController@edit')->name('admin.forms.menu.edit')->middleware('auth'); 
    Route::get('admin/menu/remove/{id}', 'MenuController@remove')->name('admin.forms.menu.remove')->middleware('auth'); 
    
        
    //biblioteka mediów
    Route::get('admin/media', 'MediaUploadController@index')->name('admin.media')->middleware('auth');
    Route::get('admin/media/create','MediaUploadController@fileCreate')->name('admin.forms.media')->middleware('auth');
    Route::post('admin/media/store','MediaUploadController@fileStore')->name('admin.forms.media.store')->middleware('auth');;
    Route::post('admin/media/remove','MediaUploadController@fileDestroy')->name('admin.forms.media.remove')->middleware('auth');;
    Route::any('admin/media/fileslist','MediaUploadController@files_list')->name('admin.media.fileslist')->middleware('auth');
    
    //tagi
    Route::get('admin/tag', 'TagController@index')->name('admin.tag')->middleware('auth'); 
    Route::get('admin/tag/create', 'TagController@create')->name('admin.forms.tag')->middleware('auth'); 
    Route::post('admin/tag/store', 'TagController@store')->name('admin.forms.tag.store')->middleware('auth'); 
    Route::post('admin/tag/update/{id}', 'TagController@update')->name('admin.forms.tag.update')->middleware('auth'); 
    Route::get('admin/tag/edit/{id}', 'TagController@edit')->name('admin.forms.tag.edit')->middleware('auth'); 
    Route::get('admin/tag/remove/{id}', 'TagController@remove')->name('admin.forms.tag.remove')->middleware('auth'); 
    Route::get('admin/tag/get/{slug_group}', 'TagController@get_tags')->name('admin.get_tags')->middleware('auth'); 
    
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
    Route::post('admin/element/upload_file', 'ElementController@upload_file')->name('admin.element.upload_file')->middleware('auth'); 
    
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
        
    //kategorie produktów
    Route::get('admin/category', 'CategoryController@index')->name('admin.category')->middleware('auth'); 
    Route::get('admin/category/create', 'CategoryController@create')->name('admin.forms.category')->middleware('auth'); 
    Route::post('admin/category/store', 'CategoryController@store')->name('admin.forms.category.store')->middleware('auth'); 
    Route::post('admin/category/update/{id}', 'CategoryController@update')->name('admin.forms.category.update')->middleware('auth'); 
    Route::get('admin/category/edit/{id}', 'CategoryController@edit')->name('admin.forms.category.edit')->middleware('auth'); 
    Route::get('admin/category/remove/{id}', 'CategoryController@remove')->name('admin.forms.category.remove')->middleware('auth'); 
    
    //flagi
    Route::get('admin/flag/get', 'TagController@get_flags')->name('admin.get_flags')->middleware('auth');
    
});

Route::namespace('App\Http\Controllers\Front')->group(function () { 
    Route::get('/login', 'LoginController@show')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.perform');
    Route::get('/logout', 'LoginController@logout')->name('logout.perform');  

    Route::get('sklep/koszyk', 'CartController@cart')->name('front.cart');
    Route::get('sklep/podsumowanie', 'CartController@checkout')->name('front.checkout');
    Route::get('sklep/zamowienie/podziekowanie/{order_id}', 'CartController@thank_you')->name('front.thank_you');
    Route::get('sklep/zamowienie/blad/{order_id}', 'CartController@order_error')->name('front.order_error');
    Route::get('sklep/metody', 'TpayController@get_link')->name('tpay.form');
    Route::get('sklep/pobierz_pliki/{element_id}', 'CartController@get_files')->name('order.get_files');
    Route::post('cart/add_to_cart', 'CartController@add_to_cart')->name('cart.add_to_cart');
    Route::post('cart/update_quantity', 'CartController@update_quantity')->name('cart.update_quantity');
    Route::post('cart/remove_product', 'CartController@remove_product')->name('cart.remove_product');
    Route::post('cart/process', 'CartController@process')->name('front.process');
    Route::get('cart/transaction_receive/{order_id}/{tr_id}/{status}/{error}', 'CartController@transaction_receive')->name('front.transaction_receive');
      
    Route::post('social/post/save', 'SocialController@save_post')->name('social.post.save');
    Route::post('social/media/store','SocialController@fileStore')->name('social.media.store')->middleware('auth');
    Route::post('social/media/remove','SocialController@fileDestroy')->name('social.media.remove')->middleware('auth');
    Route::post('social/comment/save', 'SocialController@save_comment')->name('social.comment.save')->middleware('auth');
    Route::post('social/like/save', 'SocialController@save_like')->name('social.like.save');
    Route::post('social/observed/save', 'SocialController@add_to_observed')->name('social.observed.save');
    Route::post('social/observed/remove', 'SocialController@remove_from_observed')->name('social.observed.remove');
    
    Route::get('wiadomosci', 'ChatController@index')->name('front.chat');
    Route::post('chat/participants/get', 'ChatController@get_participants')->name('front.participants.get');
    
    Route::get('/', function () { return redirect()->to('/sprawki');});
    
    foreach(Menu::all() as $menu) {
        if(!empty($menu->slug)) {
            Route::get('/'.$menu->slug, 'HomeController@index')->name('front.home');
            Route::get($menu->slug.'/{elementid}-{elementslug}', 'HomeController@show')->name('front.element');
        }
    }
    
    foreach(User::all() as $user) {
        if(!empty($user->friendly_name)) {
            Route::get('/'.$user->friendly_name, 'UserController@profile')->name('front.profile');
            Route::get('/'.$user->friendly_name.'/obserwowani', 'UserController@observed')->name('front.observed');
        }
    }
    
});
