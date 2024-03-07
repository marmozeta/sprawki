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
    
    Route::get('/admin/auth/login', 'LoginController@show')->name('admin.auth.login');
    Route::get('/admin/login', 'LoginController@show')->name('admin.login');
    Route::post('/admin/login', 'LoginController@login')->name('admin.login.perform');
    Route::post('/admin/auth/login', 'LoginController@login')->name('admin.auth.login.perform');
    Route::get('/admin/logout', 'LoginController@logout')->name('admin.logout.perform');  
    
    Route::get('admin', 'DashboardController@index')->name('admin.dashboard')->middleware('isadmin'); 
    
    //menu
    Route::get('admin/menu', 'MenuController@index')->name('admin.menu')->middleware('isadmin'); 
    Route::get('admin/menu/create', 'MenuController@create')->name('admin.forms.menu')->middleware('isadmin'); 
    Route::post('admin/menu/store', 'MenuController@store')->name('admin.forms.menu.store')->middleware('isadmin'); 
    Route::post('admin/menu/update/{id}', 'MenuController@update')->name('admin.forms.menu.update')->middleware('isadmin'); 
    Route::get('admin/menu/edit/{id}', 'MenuController@edit')->name('admin.forms.menu.edit')->middleware('isadmin'); 
    Route::get('admin/menu/remove/{id}', 'MenuController@remove')->name('admin.forms.menu.remove')->middleware('isadmin'); 
    
        
    //biblioteka mediów
    Route::get('admin/media', 'MediaUploadController@index')->name('admin.media')->middleware('isadmin');
    Route::get('admin/media/create','MediaUploadController@fileCreate')->name('admin.forms.media')->middleware('isadmin');
    Route::post('admin/media/store','MediaUploadController@fileStore')->name('admin.forms.media.store')->middleware('isadmin');
    Route::post('admin/media/remove','MediaUploadController@fileDestroy')->name('admin.forms.media.remove')->middleware('isadmin');
    Route::any('admin/media/fileslist','MediaUploadController@files_list')->name('admin.media.fileslist')->middleware('isadmin');
    
    //tagi
    Route::get('admin/tag', 'TagController@index')->name('admin.tag')->middleware('isadmin'); 
    Route::get('admin/tag/create', 'TagController@create')->name('admin.forms.tag')->middleware('isadmin'); 
    Route::post('admin/tag/store', 'TagController@store')->name('admin.forms.tag.store')->middleware('isadmin'); 
    Route::post('admin/tag/update/{id}', 'TagController@update')->name('admin.forms.tag.update')->middleware('isadmin'); 
    Route::get('admin/tag/edit/{id}', 'TagController@edit')->name('admin.forms.tag.edit')->middleware('isadmin'); 
    Route::get('admin/tag/remove/{id}', 'TagController@remove')->name('admin.forms.tag.remove')->middleware('isadmin'); 
    Route::get('admin/tag/get/{slug_group}', 'TagController@get_tags')->name('admin.get_tags')->middleware('isadmin'); 
    
    //typy
    Route::get('admin/type', 'TypeController@index')->name('admin.type')->middleware('isadmin'); 
    Route::get('admin/type/create', 'TypeController@create')->name('admin.forms.type')->middleware('isadmin'); 
    Route::post('admin/type/store', 'TypeController@store')->name('admin.forms.type.store')->middleware('isadmin'); 
    Route::post('admin/type/update/{id}', 'TypeController@update')->name('admin.forms.type.update')->middleware('isadmin'); 
    Route::get('admin/type/edit/{id}', 'TypeController@edit')->name('admin.forms.type.edit')->middleware('isadmin'); 
    Route::get('admin/type/remove/{id}', 'TypeController@remove')->name('admin.forms.type.remove')->middleware('isadmin');
    
    
    //elementy
    Route::get('admin/element/{slug}', 'ElementController@index')->name('admin.element')->middleware('isadmin'); 
    Route::get('admin/element/create/{slug}', 'ElementController@create')->name('admin.forms.element')->middleware('isadmin'); 
    Route::post('admin/element/store/{slug}', 'ElementController@store')->name('admin.forms.element.store')->middleware('isadmin'); 
    Route::post('admin/element/update/{slug}/{id}', 'ElementController@update')->name('admin.forms.element.update')->middleware('isadmin'); 
    Route::get('admin/element/edit/{slug}/{id}', 'ElementController@edit')->name('admin.forms.element.edit')->middleware('isadmin'); 
    Route::get('admin/element/remove/{slug}/{id}', 'ElementController@remove')->name('admin.forms.element.remove')->middleware('isadmin'); 
    Route::post('admin/element/upload_file', 'ElementController@upload_file')->name('admin.element.upload_file')->middleware('isadmin'); 
    
    //użytkownicy
    Route::get('admin/user', 'UserController@index')->name('admin.user')->middleware('isadmin'); 
    Route::get('admin/user/create', 'UserController@create')->name('admin.forms.user')->middleware('isadmin'); 
    Route::post('admin/user/store', 'UserController@store')->name('admin.forms.user.store')->middleware('isadmin'); 
    Route::post('admin/user/update/{id}', 'UserController@update')->name('admin.forms.user.update')->middleware('isadmin'); 
    Route::get('admin/user/edit/{id}', 'UserController@edit')->name('admin.forms.user.edit')->middleware('isadmin'); 
    Route::get('admin/user/remove/{id}', 'UserController@remove')->name('admin.forms.user.remove')->middleware('isadmin'); 
 
    //komentarze
    Route::get('admin/comment', 'CommentController@index')->name('admin.comment')->middleware('isadmin'); 
    Route::get('admin/comment/create', 'CommentController@create')->name('admin.forms.comment')->middleware('isadmin'); 
    Route::post('admin/comment/store', 'CommentController@store')->name('admin.forms.comment.store')->middleware('isadmin'); 
    Route::post('admin/comment/update/{id}', 'CommentController@update')->name('admin.forms.comment.update')->middleware('isadmin'); 
    Route::get('admin/comment/edit/{id}', 'CommentController@edit')->name('admin.forms.comment.edit')->middleware('isadmin'); 
    Route::get('admin/comment/remove/{id}', 'CommentController@remove')->name('admin.forms.comment.remove')->middleware('isadmin'); 
        
    //zamówienia
    Route::get('admin/order', 'OrderController@index')->name('admin.order')->middleware('isadmin'); 
    Route::get('admin/order/create', 'OrderController@create')->name('admin.forms.order')->middleware('isadmin'); 
    Route::post('admin/order/store', 'OrderController@store')->name('admin.forms.order.store')->middleware('isadmin'); 
    Route::post('admin/order/update/{id}', 'OrderController@update')->name('admin.forms.order.update')->middleware('isadmin'); 
    Route::get('admin/order/edit/{id}', 'OrderController@edit')->name('admin.forms.order.edit')->middleware('isadmin'); 
    Route::get('admin/order/remove/{id}', 'OrderController@remove')->name('admin.forms.order.remove')->middleware('isadmin'); 
        
    //kategorie produktów
    Route::get('admin/category', 'CategoryController@index')->name('admin.category')->middleware('isadmin'); 
    Route::get('admin/category/create', 'CategoryController@create')->name('admin.forms.category')->middleware('isadmin'); 
    Route::post('admin/category/store', 'CategoryController@store')->name('admin.forms.category.store')->middleware('isadmin'); 
    Route::post('admin/category/update/{id}', 'CategoryController@update')->name('admin.forms.category.update')->middleware('isadmin'); 
    Route::get('admin/category/edit/{id}', 'CategoryController@edit')->name('admin.forms.category.edit')->middleware('isadmin'); 
    Route::get('admin/category/remove/{id}', 'CategoryController@remove')->name('admin.forms.category.remove')->middleware('isadmin'); 
    
    //flagi
    Route::get('admin/flag/get', 'TagController@get_flags')->name('admin.get_flags')->middleware('isadmin');
    
    //menu
    Route::get('admin/settings/hot', 'SettingController@hot')->name('admin.settings.hot')->middleware('isadmin'); 
    Route::post('admin/settings/hot/update', 'SettingController@hot_update')->name('admin.settings.hot.update')->middleware('isadmin'); 
    
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
    Route::get('zamowienie/pobierz_pliki/{order_id}', 'CartController@get_files_by_order')->name('order.get_files_by_order');
    Route::post('cart/add_to_cart', 'CartController@add_to_cart')->name('cart.add_to_cart');
    Route::post('cart/update_quantity', 'CartController@update_quantity')->name('cart.update_quantity');
    Route::post('cart/remove_product', 'CartController@remove_product')->name('cart.remove_product');
    Route::post('cart/process', 'CartController@process')->name('front.process');
    Route::get('cart/transaction_receive/{order_id}/{tr_id}/{status}/{error}', 'CartController@transaction_receive')->name('front.transaction_receive');
      
    Route::post('social/post/save', 'SocialController@save_post')->name('social.post.save')->middleware('auth');
    Route::post('social/post/update', 'SocialController@update_post')->name('social.post.update')->middleware('auth');
    Route::post('social/media/store','SocialController@fileStore')->name('social.media.store')->middleware('auth');
    Route::post('social/media/remove','SocialController@fileDestroy')->name('social.media.remove')->middleware('auth');
    Route::post('social/comment/save', 'SocialController@save_comment')->name('social.comment.save')->middleware('auth');
    Route::get('social/comment/remove/{id}/{redirect}', 'SocialController@remove_comment')->name('social.comment.remove')->middleware('auth');
    Route::post('social/like/save', 'SocialController@save_like')->name('social.like.save');
    Route::post('social/observed/save', 'SocialController@add_to_observed')->name('social.observed.save')->middleware('auth');
    Route::post('social/observed/remove', 'SocialController@remove_from_observed')->name('social.observed.remove')->middleware('auth');
    
    Route::get('wiadomosci', 'ChatController@index')->name('front.chat')->middleware('auth');
    Route::get('wiadomosci/{hash}', 'ChatController@chat')->name('front.chat.show')->middleware('auth');
    Route::post('chat/participants/get', 'ChatController@get_participants')->name('front.participants.get')->middleware('auth');
    Route::post('chat/messenger/new', 'ChatController@new_chat')->name('front.messenger.new')->middleware('auth');
    
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
