<?php
use Illuminate\Support\Facades\Route;

// auth
Route::post('login'              , 'Apis\AuthController@login');
Route::post('register'           , 'Apis\AuthController@register');
Route::post('forget_password'    , 'Apis\AuthController@forget_password');
Route::post('renew_password'     , 'Apis\AuthController@renew_password');

// ads
Route::get('ads'                 , 'Apis\AdsController@ads');
Route::post('ad_images'          , 'Apis\AdsController@ad_images');

// categories
Route::post('categories'         , 'Apis\CategoriesController@categories');
Route::post('categories_search'  , 'Apis\CategoriesController@categories_search');
Route::post('category_products'  , 'Apis\CategoriesController@category_products');

// countries
Route::post('countries'          , 'Apis\ApisController@countries');

// products
Route::post('show_product'       , 'Apis\ProductsController@show_product');
Route::post('products_search'    , 'Apis\ProductsController@products_search');
Route::post('products_filter'    , 'Apis\ProductsController@products_filter');
Route::post('show_product'       , 'Apis\ProductsController@show_product');

// Fav
Route::post('set_fav'            , 'Apis\FavsController@set_fav');
Route::post('get_fav'            , 'Apis\FavsController@get_fav');

Route::group(['middleware' => ['jwt']], function (){
    // ads
    Route::post('add_ads'        , 'Apis\AdsController@add_ads');

    // products
    Route::post('add_product'    , 'Apis\ProductsController@add_product');
    Route::post('edit_product'   , 'Apis\ProductsController@edit_product');
    Route::post('delete_image'   , 'Apis\ProductsController@delete_image');
    Route::post('rate'           , 'Apis\ProductsController@rate');
    Route::post('product_report' , 'Apis\ProductsController@product_report');

    // Rate
    Route::post('set_rate'       , 'Apis\ProductsController@delete_image');

    // user
    Route::post('user_data'      , 'Apis\AuthController@user_data');

    // Comments
    Route::post('comment'        , 'Apis\CommentsController@comment');
    Route::post('comment_report' , 'Apis\CommentsController@comment_report');

    // Offers
    Route::post('set_offer'      , 'Apis\OffersController@set_offer');
    Route::post('offers'         , 'Apis\OffersController@offers');
});