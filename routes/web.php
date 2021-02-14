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



Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'mitra'], function(){
    route::get('/','MitraController@index')->name('mitra');
    route::post('/store','MitraController@store')->name('mitra.store');
    route::get('/edit/{mitra}','MitraController@edit')->name('mitra.edit');
    route::patch('/update/{mitra}', 'MitraController@update')->name('mitra.update');
    route::delete('delete/{mitra}', 'MitraController@destroy')->name('mitra.delete');
});

Route::group(['prefix'=>'testimoni'], function(){
    route::get('/','TestimoniController@index')->name('testimoni');
    route::post('/store','TestimoniController@store')->name('testimoni.store');
    route::get('/edit/{testimoni}','TestimoniController@edit')->name('testimoni.edit');
    route::patch('/update/{testimoni}','TestimoniController@update')->name('testimoni.update');
    route::delete('/delete/{testimoni}','TestimoniController@destroy')->name('testimoni.delete');
});


Route::group(['prefix' => 'gallery'], function(){
    route::get('/', 'GalleryController@index')->name('gallery');
    route::post('/store', 'GalleryController@store')->name('gallery.store');
    route::get('/edit/{gallery}', 'GalleryController@edit')->name('gallery.edit');
    route::patch('/update/{gallery}', 'GalleryController@update')->name('gallery.update');
    route::delete('/delete/{gallery}', 'GalleryController@destroy')->name('gallery.delete');
});

Route::group(['prefix' => 'promo'], function(){
    route::get('/', 'PromoController@index')->name('promo');
    route::post('/store', 'PromoController@store')->name('promo.store');
    route::get('/edit/{promo}', 'PromoController@edit')->name('promo.edit');
    route::patch('/update/{promo}', 'PromoController@update')->name('promo.update');
    route::delete('/delete/{promo}', 'PromoController@destroy')->name('promo.delete');
});