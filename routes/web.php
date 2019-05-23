<?php

use Illuminate\Support\Facades\Route;

// Site Index
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/login', 'AuthController@loginForm')->name('loginForm');

    Route::post('/login', 'AuthController@login')->name('login');

    // Auth user only
    Route::group(['middleware' => ['admin', 'check_role']], function () {

        Route::get('/', [
            'uses' => 'AuthController@dashboard',
            'as' => 'dashboard',
            'icon' => '<i class="fa fa-dashboard"></i>',
            'title' => 'الرئيسيه'
        ]);

        // ============= Permission ==============
        Route::get('permissions-list', [
            'uses' => 'PermissionController@index',
            'as' => 'permissionslist',
            'title' => 'قائمة الصلاحيات',
            'icon' => '<i class="fa fa-eye"></i>',
            'child' => [
                'addpermissionspage',
                'addpermission',
                'editpermissionpage',
                'updatepermission',
                'deletepermission',

            ]
        ]);

        Route::get('permissions', [
            'uses' => 'PermissionController@create',
            'as' => 'addpermissionspage',
            'title' => 'اضافة صلاحيه',
        ]);

        Route::post('add-permission', [
            'uses' => 'PermissionController@store',
            'as' => 'addpermission',
            'title' => 'تمكين اضافة صلاحيه'
        ]);

        #edit permissions page
        Route::get('edit-permissions/{id}', [
            'uses' => 'PermissionController@edit',
            'as' => 'editpermissionpage',
            'title' => 'تعديل صلاحيه'
        ]);

        #update permission
        Route::post('update-permission', [
            'uses' => 'PermissionController@update',
            'as' => 'updatepermission',
            'title' => 'تمكين تعديل صلاحيه'
        ]);

        #delete permission
        Route::post('delete-permission', [
            'uses' => 'PermissionController@destroy',
            'as' => 'deletepermission',
            'title' => 'حذف صلاحيه'
        ]);

        Route::get('/admins', [
            'uses' => 'AdminController@index',
            'as' => 'admins',
            'title' => 'المشرفين',
            'icon' => '<i class="fa fa-user-circle"></i>',
            'child' => [
                'addadmin',
                'updateadmin',
                'deleteadmin',
                'deleteadmins',
            ]
        ]);

        Route::post('/add-admin', [
            'uses' => 'AdminController@store',
            'as' => 'addadmin',
            'title' => 'اضافة مشرف'
        ]);

        // Update User
        Route::post('/update-admin', [
            'uses' => 'AdminController@update',
            'as' => 'updateadmin',
            'title' => 'تعديل مشرف'
        ]);

        // Delete User
        Route::post('/delete-admin', [
            'uses' => 'AdminController@delete',
            'as' => 'deleteadmin',
            'title' => 'حذف مشرف'
        ]);

        // Delete Users
        Route::post('/delete-admins', [
            'uses' => 'AdminController@deleteAllAdmins',
            'as' => 'deleteadmins',
            'title' => 'حذف اكتر من مشرف'
        ]);


        Route::get('/users', [
            'uses' => 'UsersController@index',
            'as' => 'users',
            'title' => 'الاعضاء ',
            'icon' => '<i class="fa fa-users"></i>',
            'child' => [
                'adduser',
                'updateuser',
                'deleteuser',
                'deleteusers',
                'send-fcm',
            ]
        ]);

        // Add User
        Route::post('/add-user', [
            'uses' => 'UsersController@store',
            'as' => 'adduser',
            'title' => 'اضافة عضو'
        ]);

        // Update User
        Route::post('/update-user', [
            'uses' => 'UsersController@update',
            'as' => 'updateuser',
            'title' => 'تعديل عضو'
        ]);

        // Delete User
        Route::post('/delete-user', [
            'uses' => 'UsersController@delete',
            'as' => 'deleteuser',
            'title' => 'حذف عضو'
        ]);

        // Delete Users
        Route::post('/delete-users', [
            'uses' => 'UsersController@deleteAll',
            'as' => 'deleteusers',
            'title' => 'حذف اكتر من عضو'
        ]);
      
        // Send Notify
        Route::post('/send-notify', [
            'uses' => 'UsersController@sendNotify',
            'as' => 'send-fcm',
            'title' => 'ارسال اشعارات'
        ]);

        // ======== Categories
        Route::get('/categories', [
            'uses' => 'CategoriesController@index',
            'as' => 'categories',
            'title' => 'الاقسام ',
            'icon' => '<i class="fa fa-bars"></i>',
            'child' => [
                'addCategory',
                'updateCategory',
                'deleteCategory',
                'deleteCategories',
            ]
        ]);

        // Add Category
        Route::post('/add-category', [
            'uses' => 'CategoriesController@addCategory',
            'as' => 'addCategory',
            'title' => 'اضافة قسم'
        ]);

        // Update Category
        Route::post('/update-category', [
            'uses' => 'CategoriesController@updateCategory',
            'as' => 'updateCategory',
            'title' => 'تعديل قسم'
        ]);

        // Delete Category
        Route::post('/delete-category', [
            'uses' => 'CategoriesController@deleteCategory',
            'as' => 'deleteCategory',
            'title' => 'حذف قسم'
        ]);

        // Delete Categories
        Route::post('/delete-categories', [
            'uses' => 'CategoriesController@deleteAllCategories',
            'as' => 'deleteCategories',
            'title' => 'حذف اكتر من قسم'
        ]);


        // ======== Ads
        Route::get('/all-ads', [
            'uses' => 'AdsController@index',
            'as' => 'ads',
            'title' => 'الاعلانات ',
            'icon' => '<i class="fa fa-map-signs"></i>',
            'child' => [
                'addAd',
                'updateAd',
                'deleteAd',
                'deleteAds',
            ]
        ]);

        // Add ad
        Route::post('/add-ad', [
            'uses' => 'AdsController@addAd',
            'as' => 'addAd',
            'title' => 'اضافة اعلان'
        ]);

        // Update ad
        Route::post('/update-ad', [
            'uses' => 'AdsController@updateAd',
            'as' => 'updateAd',
            'title' => 'تعديل اعلان'
        ]);

        // Delete ad
        Route::post('/delete-ad', [
            'uses' => 'AdsController@deleteAd',
            'as' => 'deleteAd',
            'title' => 'حذف اعلان'
        ]);

        // Delete ads
        Route::post('/delete-ads', [
            'uses' => 'AdsController@deleteAllAds',
            'as' => 'deleteAds',
            'title' => 'حذف اكتر من اعلان'
        ]);

        // ======== Contact Us
        Route::get('/contact-us', [
            'uses' => 'ContactUsController@index',
            'as' => 'contact-us',
            'title' => 'اتصل بنا',
            'icon' => '<i class="fa fa-phone"></i>',
            'child' => [
                'deleteMsg',
                'replayMsg',
                'deleteAllMsg',
            ]
        ]);

        // delete msg
        Route::post('/delete-msg', [
            'uses' => 'ContactUsController@deleteMsg',
            'as' => 'deleteMsg',
            'title' => 'حذف الرسالة'
        ]);

        // Replay MSG
        Route::post('/replay-msg', [
            'uses' => 'ContactUsController@replayMsg',
            'as' => 'replayMsg',
            'title' => 'الرد علي الرسائل'
        ]);

        // Delete All Msg
        Route::post('/delete-all-msg', [
            'uses' => 'ContactUsController@deleteAllMsg',
            'as' => 'deleteAllMsg',
            'title' => 'حذف اكتر من رسالة'
        ]);


        // ======== Countries
        Route::get('/countries', [
            'uses'  => 'CountriesController@index',
            'as'    => 'countries',
            'title' => 'الدول',
            'icon'  => '<i class="fa fa-globe"></i>',
            'child' => [
                'addCountry',
                'updateCountry',
                'deleteCountry',
                'deleteCountries',
            ]
        ]);

        // Add Country
        Route::post('/add-country', [
            'uses'  => 'CountriesController@addCountry',
            'as'    => 'addCountry',
            'title' => 'اضافة دولة'
        ]);

        // Update Country
        Route::post('/update-country', [
            'uses'  => 'CountriesController@updateCountry',
            'as'    => 'updateCountry',
            'title' => 'تعديل دولة'
        ]);

        // Delete Country
        Route::post('/delete-country', [
            'uses'  => 'CountriesController@deleteCountry',
            'as'    => 'deleteCountry',
            'title' => 'حذف دولة'
        ]);

        // Delete Countries
        Route::post('/delete-countries', [
            'uses'  => 'CountriesController@deleteCountries',
            'as'    => 'deleteCountries',
            'title' => 'حذف اكتر من دولة'
        ]);


        // ======== Reports
        Route::get('all-reports', [
            'uses' => 'ReportController@index',
            'as' => 'allreports',
            'title' => 'التقارير',
            'icon' => '<i class="fa fa-flag"></i>',
            'child' => [
                'deletereports',
            ]
        ]);

        Route::get('/delete-reports', [
            'uses' => 'ReportController@delete',
            'as' => 'deletereports',
            'title' => 'حذف التقارير'
        ]);
        // ========== Settings

        Route::get('settings', [
            'uses' => 'SettingController@index',
            'as' => 'settings',
            'title' => 'الاعدادات',
            'icon' => '<i class="fa fa-cogs"></i>',
            'child' => [
                'sitesetting',
                'about',
                'add-social',
                'update-social',
                'delete-social',
                'post-about-app',
                'post-policy',
            ]
        ]);

        // General Settings
        Route::post('/update-settings', [
            'uses' => 'SettingController@updateSiteInfo',
            'as' => 'sitesetting',
            'title' => 'تعديل بيانات الموقع'
        ]);

        Route::post('/about-us', [
            'uses' => 'SettingController@about',
            'as' => 'about',
            'title' => 'تعديل بيانات الموقع'
        ]);

        // Social Sites
        Route::post('/add-social', [
            'uses' => 'SettingController@storeSocial',
            'as' => 'add-social',
            'title' => 'اضافة مواقع التواصل'
        ]);

        Route::post('/update-social', [
            'uses' => 'SettingController@updateSocial',
            'as' => 'update-social',
            'title' => 'تعديل مواقع التواصل'
        ]);

        Route::get('/delete-social/{id}', [
            'uses' => 'SettingController@deleteSocial',
            'as' => 'delete-social',
            'title' => 'حذف مواقع التواصل'
        ]);

        Route::post('/post-about-app', [
            'uses' => 'SettingController@aboutApp',
            'as' => 'post-about-app',
            'title' => 'عن التطبيق'
        ]);

        Route::post('/post-policy', [
            'uses' => 'SettingController@policy',
            'as' => 'post-policy',
            'title' => 'الشروط و الاحكام'
        ]);

    });
    Route::any('/logout', 'AuthController@logout')->name('logout');
});
