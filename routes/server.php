<?php
/**
 * Pterodactyl - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */
Route::get('/', 'ConsoleController@index')->name('server.index');
Route::get('/console', 'ConsoleController@console')->name('server.console');

/*
|--------------------------------------------------------------------------
| Server Settings Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /server/{server}/settings
|
*/
Route::group(['prefix' => 'settings'], function () {
    Route::get('/allocation', 'Settings\AllocationController@index')->name('server.settings.allocation');
    Route::patch('/allocation', 'Settings\AllocationController@update');

    Route::get('/sftp', 'Settings\SftpController@index')->name('server.settings.sftp');

    Route::get('/startup', 'Settings\StartupController@index')->name('server.settings.startup');
    Route::patch('/startup', 'Settings\StartupController@update');
});

/*
|--------------------------------------------------------------------------
| Server Database Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /server/{server}/databases
|
*/
Route::group(['prefix' => 'databases'], function () {
    Route::get('/', 'DatabaseController@index')->name('server.databases.index');

    Route::patch('/password', 'DatabaseController@update')->middleware('server..database')->name('server.databases.password');
});

/*
|--------------------------------------------------------------------------
| Server File Manager Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /server/{server}/files
|
*/
Route::group(['prefix' => 'files'], function () {
    Route::get('/', 'Files\FileActionsController@index')->name('server.files.index');
    Route::get('/add', 'Files\FileActionsController@create')->name('server.files.add');
    Route::get('/edit/{file}', 'Files\FileActionsController@update')->name('server.files.edit')->where('file', '.*');
    Route::get('/download/{file}', 'Files\DownloadController@index')->name('server.files.edit')->where('file', '.*');

    Route::post('/directory-list', 'Files\RemoteRequestController@directory')->name('server.files.directory-list');
    Route::post('/save', 'Files\RemoteRequestController@store')->name('server.files.save');
});

/*
|--------------------------------------------------------------------------
| Server Subuser Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /server/{server}/users
|
*/
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'SubuserController@index')->name('server.subusers');
    Route::get('/new', 'SubuserController@create')->name('server.subusers.new');
    Route::post('/new', 'SubuserController@store');

    Route::group(['middleware' => 'server..subuser'], function () {
        Route::get('/view/{subuser}', 'SubuserController@view')->name('server.subusers.view');
        Route::patch('/view/{subuser}', 'SubuserController@update');
        Route::delete('/view/{subuser}', 'SubuserController@delete');
    });
});

/*
|--------------------------------------------------------------------------
| Server Task Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /server/{server}/tasks
|
*/
Route::group(['prefix' => 'schedules'], function () {
    Route::get('/', 'Tasks\TaskManagementController@index')->name('server.schedules');
    Route::get('/new', 'Tasks\TaskManagementController@create')->name('server.schedules.new');
    Route::post('/new', 'Tasks\TaskManagementController@store');

    Route::group(['middleware' => 'server..schedule'], function () {
        Route::get('/view/{schedule}', 'Tasks\TaskManagementController@view')->name('server.schedules.view');

        Route::patch('/view/{schedule}', 'Tasks\TaskManagementController@update');
        Route::patch('/view/{schedule}/toggle', 'Tasks\TaskToggleController@index')->name('server.schedules.toggle');

        Route::delete('/view/{schedule}', 'Tasks\TaskManagementController@delete');
    });
});

/*
|--------------------------------------------------------------------------
| Server Plugin Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /server/{server}/plugins
|
*/
Route::group(['prefix' => 'plugins'], function () {
    Route::get('/', 'PluginController@index')->name('server.plugins');
    Route::patch('/', 'PluginController@update');
    Route::get('/config', 'PluginController@config')->name('server.plugins.config');
});

/*
|--------------------------------------------------------------------------
| Server Admin Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /server/{server}/admins
|
*/
Route::group(['prefix' => 'admins'], function () {
    Route::get('/', 'AdminController@index')->name('server.admins');
    Route::get('/new', 'AdminController@create')->name('server.admins.new');
    Route::post('/new', 'AdminController@store');

    Route::group(['middleware' => 'server..admin'], function () {
        Route::get('/view/{admin}', 'AdminController@view')->name('server.admins.view');
        Route::patch('/view/{admin}', 'AdminController@update');
        Route::delete('/view/{admin}', 'AdminController@delete');
    });
});
