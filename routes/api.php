<?php
use Illuminate\Support\Facades\Route;

// auth
Route::post('login'             , 'Apis\AuthController@login');
Route::post('register'          , 'Apis\AuthController@register');
Route::post('forget_password'   , 'Apis\AuthController@forget_password');
Route::post('renew_password'    , 'Apis\AuthController@renew_password');

// ads
Route::get('ads'                , 'Apis\AdsController@ads');
Route::post('ad_images'         , 'Apis\AdsController@ad_images');

// categories
Route::post('categories'         , 'Apis\CategoriesController@categories');
Route::post('categories_search'  , 'Apis\CategoriesController@categories_search');

// countries
Route::post('countries'          , 'Apis\ApisController@countries');


Route::group(['middleware' => ['jwt']], function (){
    // ads
    Route::post('add_ads'        , 'Apis\AdsController@add_ads');

    // products
    Route::post('add_product'    , 'Apis\ProductsController@add_product');
    Route::post('edit_product'   , 'Apis\ProductsController@edit_product');
    Route::post('delete_image'   , 'Apis\ProductsController@delete_image');
});