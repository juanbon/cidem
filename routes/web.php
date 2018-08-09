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

Route::get('/', function () {
    return view('welcome');
});


/*


Route::group(['middleware' => ['role:super-admin']], function () {
    //
});

['middleware' => ['role:admin']],

*/



Route::get('admin/line/{id}/preview', 'LineController@index');
Route::get('admin/ajax/getUser', 'Admin\UserCrudController@getUser');
Route::get('admin/ajax/getRecipients/{id?}', 'Admin\RecipientCrudController@getRecipients');
Route::post('admin/ajax/UpdateUser', 'admin\UserCrudController@updateUser');
Route::get('admin/ajax/getRecipientsbyUser/{id?}', 'Admin\RecipientCrudController@getRecipientsbyUser');


// Solo accedido por el Admin  ['role:admin'],

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function() {
   CRUD::resource('lines', 'LineCrudController');
   CRUD::resource('areas', 'AreaCrudController');
   CRUD::resource('financing-types', 'FinancingTypeCrudController');
   CRUD::resource('modalities', 'ModalityCrudController');
   CRUD::resource('recipients', 'RecipientCrudController');
   CRUD::resource('user', 'UserCrudController');

});



// Redirecciona por el admin

Route::get('home', 'Admin\dashboardcontroller@index'); // ->middleware('role:admin');
Route::get('admin/home', 'Admin\dashboardcontroller@index'); // ->middleware('role:admin');
Route::get('admin/dashboard', 'Admin\dashboardcontroller@index'); // ->middleware('role:admin');
Route::post('admin/register', 'Auth\RegisterController@register');

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
    Route::post('login', 'Auth\LoginController@login');
});