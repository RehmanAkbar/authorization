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




/********************************************************** Administration ******************************************************/

Route::group(['prefix'=>'administration'],function (){
    Route::group(['prefix'=>'user-management'],function (){
        Route::resource('permissions', 'PermissionsController');
        Route::post('add_permissions' , 'RolesController@addPermission')->name('add_permissions');

        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::resource('user', 'UsersController');
        Route::resource('usertypes', 'UserTypesController');
    });

    Route::resource('companies', 'CompaniesController');
    Route::resource('offices', 'OfficesController');

    Route::resource('countries', 'CountriesController');
    Route::resource('cities', 'CitiesController');

});

/********************************************************** End Administration Routes ***********************************************/



