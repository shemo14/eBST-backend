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
Route::post('view_product'       , 'Apis\ProductsController@view_product');
Route::post('best_products'      , 'Apis\ProductsController@best_products');

// Fav
Route::post('set_fav'            , 'Apis\FavsController@set_fav');
Route::post('get_fav'            , 'Apis\FavsController@get_fav');

// about us
Route::post('about-us'            , 'Apis\AppController@about_us');

// policy
Route::post('policy'              , 'Apis\AppController@policy');

// app info
Route::post('app-info'              , 'Apis\AppController@app_info');

// contact us
Route::post('contact-us'            , 'Apis\AppController@contact_us');

Route::group(['middleware' => ['jwt']], function (){
    // ads
    Route::post('add_ads'               , 'Apis\AdsController@add_ads');

    // products
    Route::post('add_product'           , 'Apis\ProductsController@add_product');
    Route::post('edit_product'          , 'Apis\ProductsController@edit_product');
    Route::post('delete_image'          , 'Apis\ProductsController@delete_image');
    Route::post('rate'                  , 'Apis\ProductsController@rate');
    Route::post('product_report'        , 'Apis\ProductsController@product_report');
    Route::post('my_products'           , 'Apis\ProductsController@my_products');
    Route::post('search_my_products'    , 'Apis\ProductsController@search_my_products');
    Route::post('delete_product'        , 'Apis\ProductsController@delete_product');

    // Rate
    Route::post('set_rate'              , 'Apis\ProductsController@delete_image');

    // user
    Route::post('user_data'             , 'Apis\AuthController@user_data');

    // Comments
    Route::post('comment'               , 'Apis\CommentsController@comment');
    Route::post('comment_report'        , 'Apis\CommentsController@comment_report');

    // Offers
    Route::post('set_offer'             , 'Apis\OffersController@set_offer');
    Route::post('offers'                , 'Apis\OffersController@offers');
    Route::post('product_offers'        , 'Apis\OffersController@product_offers');
    Route::post('offer_action'          , 'Apis\OffersController@offer_action');
    Route::post('offer_details'         , 'Apis\OffersController@offer_details');
    Route::post('delete_offer'          , 'Apis\OffersController@delete_offer');

    // Notifications
    Route::post('notifications'         , 'Apis\NotifyController@notifications');
    Route::post('stop-notifications'    , 'Apis\NotifyController@stop_notifications');
});