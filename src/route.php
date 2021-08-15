<?php
use Illuminate\Support\Facades\Route;

Route::prefix(config('easysale.prefix'))->middleware(config('easysale.middleware'))->namespace('AdemOzmermer\Controllers')->group(function (){

    Route::get('/', 'PackageController@index')->name('easysale::index');
    Route::get('/category/{slug}', 'PackageController@category')->name('easysale::category');
    Route::get('/product/{slug}', 'PackageController@product')->name('easysale::product');

});
