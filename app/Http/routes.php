<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'web'], function () {
	Route::group(['middleware' => 'install'], function () {
		Route::get('/','HomeController@hello');
	});
	//Auth
	Route::auth();
	Route::group(['middleware' => 'auth'], function () {
	    Route::get('/home', 'HomeController@index');
		//Admin access URL: admin/*
	    Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
			Route::get('/', 'AdminController@dashboard');
		});
		/**/
	    //Route::resource('users', 'UserController');
		Route::get('users',['as'=>'users.index','uses'=>'UserController@index','middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);
		Route::get('users/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => ['permission:user-create']]);
		Route::post('users/create',['as'=>'users.store','uses'=>'UserController@store','middleware' => ['permission:user-create']]);
		Route::get('users/{id}',['as'=>'users.show','uses'=>'UserController@show']);
		Route::get('users/{id}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => ['permission:user-edit']]);
		Route::patch('users/{id}',['as'=>'users.update','uses'=>'UserController@update','middleware' => ['permission:user-edit']]);
		Route::delete('users/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy','middleware' => ['permission:user-delete']]);

		Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
		Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
		Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
		Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
		Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
		Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
		Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
		/*Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
		Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
		Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
		Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
		Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
		Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
		Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);*/
		/**/
	});
/*
      |============================================================
      |  Installer Routes
      |============================================================
      |  These routes are for installer
      |
     */
    Route::get('/serial', ['as' => 'serialkey', 'uses' => 'InstallController@serialkey']);
    Route::post('/CheckSerial/{id}', ['as' => 'CheckSerial', 'uses' => 'InstallController@PostSerialKey']);
    Route::get('/JavaScript-disabled', ['as' => 'js-disabled', 'uses' => 'InstallController@jsDisabled']);
    Route::get('/step1', ['as' => 'licence', 'uses' => 'InstallController@licence']);
    Route::post('/step1post', ['as' => 'postlicence', 'uses' => 'InstallController@licencecheck']);
    Route::get('/step2', ['as' => 'prerequisites', 'uses' => 'InstallController@prerequisites']);
    Route::post('/step2post', ['as' => 'postprerequisites', 'uses' => 'InstallController@prerequisitescheck']);
    // Route::get('/step3', ['as' => 'localization', 'uses' => 'InstallController@localization']);
    // Route::post('/step3post', ['as' => 'postlocalization', 'uses' => 'InstallController@localizationcheck']);
    Route::get('/step3', ['as' => 'configuration', 'uses' => 'InstallController@configuration']);
    Route::post('/step4post', ['as' => 'postconfiguration', 'uses' => 'InstallController@configurationcheck']);
    Route::get('/step4', ['as' => 'database', 'uses' => 'InstallController@database']);
    Route::get('/step5', ['as' => 'account', 'uses' => 'InstallController@account']);
    Route::post('/step6post', ['as' => 'postaccount', 'uses' => 'InstallController@accountcheck']);
    Route::get('/final', ['as' => 'final', 'uses' => 'InstallController@finalize']);
    Route::post('/finalpost', ['as' => 'postfinal', 'uses' => 'InstallController@finalcheck']);
    Route::post('/postconnection', ['as' => 'postconnection', 'uses' => 'InstallController@postconnection']);
    Route::get('/change-file-permission', ['as' => 'change-permission', 'uses' => 'InstallController@changeFilePermission']);


    Route::get('test111', function() {
    	
    	Cache::tags(['test111'])->put('testa','asdasd');
    	$cache = Cache::tags(['test111'])->get('Anne');
    	echo "<pre>"; var_dump($cache); echo "</pre>"; die;
    });
});