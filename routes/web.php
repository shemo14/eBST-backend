<?php

// Site Index
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::get('/login', 'AdminController@loginForm')->name('loginForm');

    Route::post('/login', 'AdminController@login')->name('login');

    // Auth user only
    Route::group(['middleware' => ['admin', 'check_role']], function () {

        Route::get('/',[
            'uses'  =>'AdminController@dashboard',
            'as'    =>'dashboard',
            'icon'  =>'<i class="fa fa-dashboard"></i>',
            'title' =>'الرئيسيه'
        ]);

        // ============= Permission ==============
        Route::get('permissions-list',[
            'uses' =>'PermissionController@index',
            'as'   =>'permissionslist',
            'title'=>'قائمة الصلاحيات',
            'icon' =>'<i class="fa fa-eye"></i>',
            'child'=>[
                'addpermissionspage',
                'addpermission',
                'editpermissionpage',
                'updatepermission',
                'deletepermission',

            ]
        ]);

        #add permissions page
        Route::get('permissions',[
            'uses' =>'PermissionController@create',
            'as'   =>'addpermissionspage',
            'title'=>'اضافة صلاحيه',
        ]);

        #add permission
        Route::post('add-permission',[
            'uses' =>'PermissionController@store',
            'as'   =>'addpermission',
            'title' =>'تمكين اضافة صلاحيه'
        ]);

        #edit permissions page
        Route::get('edit-permissions/{id}',[
            'uses' =>'PermissionController@edit',
            'as'   =>'editpermissionpage',
            'title'=>'تعديل صلاحيه'
        ]);

        #update permission
        Route::post('update-permission',[
            'uses' =>'PermissionController@update',
            'as'   =>'updatepermission',
            'title'=>'تمكين تعديل صلاحيه'
        ]);

        #delete permission
        Route::post('delete-permission',[
            'uses'=>'PermissionController@destroy',
            'as'  =>'deletepermission',
            'title' =>'حذف صلاحيه'
        ]);

        Route::get('/all-users',[
            'uses'     =>'UsersController@index',
            'as'       =>'users',
            'title'    =>'الاعضاء ',
            'subTitle' =>'المشرفين',
            'subIcon'  =>'<i class="glyphicon glyphicon-film"></i>',
            'icon'     =>'<i class="fa fa-users"></i>',
            'child'    => [
                'normal-user',
                'admins',
                'addadmin',
                'updateadmin',
                'deleteadmin',
                'deleteadmins',
                'adduser',
                'updateuser',
                'deleteuser',
                'deleteusers',
                'send-fcm',
            ]
        ]);

        // users
        Route::get('/normal-user',[
            'uses'=>'UsersController@index',
            'as'=>'normal-user',
            'icon'      =>'<i class="fa fa-user"></i>',
            'title'    => 'المستخدمين',
            'hasFather' =>true
        ]);

        // admins
        Route::get('/admins',[
            'uses'=>'UsersController@admins',
            'as'=>'admins',
            'icon'      =>'<i class="fa fa-user-circle"></i>',
            'title'    => 'المشرفين',
            'hasFather' =>true
        ]);

        // Add User
        Route::post('/add-user',[
            'uses'  => 'UsersController@storeUser',
            'as'    => 'adduser',
            'title' => 'اضافة عضو'
        ]);

        // Update User
        Route::post('/update-user',[
            'uses'  => 'UsersController@updateUser',
            'as'    => 'updateuser',
            'title' => 'تعديل عضو'
        ]);

        // Delete User
        Route::post('/delete-user',[
            'uses'  => 'UsersController@deleteUser',
            'as'    => 'deleteuser',
            'title' => 'حذف عضو'
        ]);

        // Delete Users
        Route::post('/delete-users',[
            'uses'  => 'UsersController@deleteAll',
            'as'    => 'deleteusers',
            'title' => 'حذف اكتر من عضو'
        ]);

        // Add admin
        Route::post('/add-admin',[
            'uses'  => 'UsersController@storeAdmin',
            'as'    => 'addadmin',
            'title' => 'اضافة مشرف'
        ]);

        // Update User
        Route::post('/update-admin',[
            'uses'  => 'UsersController@updateAdmin',
            'as'    => 'updateadmin',
            'title' => 'تعديل مشرف'
        ]);

        // Delete User
        Route::post('/delete-admin',[
            'uses'  => 'UsersController@deleteAdmin',
            'as'    => 'deleteadmin',
            'title' => 'حذف مشرف'
        ]);

        // Delete Users
        Route::post('/delete-admins',[
            'uses'  => 'UsersController@deleteAllAdmins',
            'as'    => 'deleteadmins',
            'title' => 'حذف اكتر من مشرف'
        ]);

        // Send Notify
        Route::post('/send-notify',[
            'uses'  => 'UsersController@sendNotify',
            'as'    => 'send-fcm',
            'title' => 'ارسال اشعارات'
        ]);

        // ======== Reports
        Route::get('all-reports',[
            'uses' =>'ReportController@index',
            'as'   =>'reports',
            'title'=>'التقارير',
            'icon' =>'<i class="fa fa-flag"></i>',
            'child'=>[
                'allreports',
                'deletereports',
            ]
        ]);

        Route::get('/reports',[
            'uses'  => 'ReportController@index',
            'as'    => 'allreports',
            'title' => 'عرض التقارير'
        ]);

        Route::get('/delete-reports',[
            'uses'  => 'ReportController@delete',
            'as'    => 'deletereports',
            'title' => 'حذف التقارير'
        ]);
        // ========== Settings

        Route::get('settings',[
            'uses' =>'SettingController@index',
            'as'   =>'settings',
            'title'=>'الاعدادات',
            'icon' =>'<i class="fa fa-cogs"></i>',
            'child'=>[
                'sitesetting',
                'about',
                'add-social',
                'update-social',
                'delete-social',
            ]
        ]);

        // General Settings
        Route::post('/update-settings',[
            'uses'  => 'SettingController@updateSiteInfo',
            'as'    => 'sitesetting',
            'title' => 'تعديل بيانات الموقع'
        ]);

        Route::post('/about-us',[
            'uses'  => 'SettingController@about',
            'as'    => 'about',
            'title' => 'تعديل بيانات الموقع'
        ]);

        // Social Sites
        Route::post('/add-social',[
            'uses'  => 'SettingController@storeSocial',
            'as'    => 'add-social',
            'title' => 'اضافة مواقع التواصل'
        ]);

        Route::post('/update-social',[
            'uses'  => 'SettingController@updateSocial',
            'as'    => 'update-social',
            'title' => 'تعديل مواقع التواصل'
        ]);

        Route::get('/delete-social/{id}',[
            'uses'  => 'SettingController@deleteSocial',
            'as'    => 'delete-social',
            'title' => 'حذف مواقع التواصل'
        ]);

    });
    Route::any('/logout', 'AdminController@logout')->name('logout');
});
