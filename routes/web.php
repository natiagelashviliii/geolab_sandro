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

// Route::get('/', function () {
//     return view('main/index');
// });

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::any('/home/changemode', 'HomeController@ChangeMode');
Route::get('/about', 'AboutController@index');
Route::get('/contact', 'ContactController@index');


Route::get('/works/{slug?}', 'WorksController@index');
Route::get('/works/explore/{tag}', 'WorksController@explore');
Route::post('/works/getProject', 'WorksController@getProject');
Route::post('/works/loadProjects', 'WorksController@loadProjects');
Route::post('/works/getProjectContent', 'WorksController@getProjectContent');
Route::post('/works/getSiblingProjects', 'WorksController@getSiblingProjects');


Route::get('404', ['uses' => 'ErrorController@index', 'as' => 'errors.404']);


// Admin routes

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::prefix('admin')->group(function(){

	Route::get('/',       ['uses' => 'Admin\HomeController@index', 'as' => 'admin.dashboard']);

    /* about routes */
    Route::group(['prefix' => 'about'], function() {
        Route::get('/', ['uses' => 'Admin\AboutController@index', 'as' => 'admin.about.index']);
        Route::post('/edit', 'Admin\AboutController@EditAbout');
    });

    /* user routes */
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', ['uses' => 'Admin\UserController@index', 'as' => 'admin.user.index']);
        Route::post('/edit', 'Admin\UserController@edit');
        Route::post('/changePassword', 'Admin\UserController@changePassword');
    });

    /* contact routes */
    Route::group(['prefix' => 'contact'], function() {
        Route::get('/', ['uses' => 'Admin\ContactController@index', 'as' => 'admin.contact.index']);
        Route::post('/edit', 'Admin\ContactController@EditContact');
    });

    /* Categories routes */
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', ['uses' => 'Admin\CategoriesController@index', 'as' => 'admin.categories.index']);
        Route::get('/add', ['uses' => 'Admin\CategoriesController@add', 'as' => 'admin.categories.add']);
        Route::post('/addCategory', 'Admin\CategoriesController@AddCategory');
        Route::get('/edit/{id}', [ 'uses' => 'Admin\CategoriesController@edit', 'as' => 'admin.categories.edit']);
        Route::post('/editCategory', 'Admin\CategoriesController@EditCategory');
        Route::post('/delete', 'Admin\CategoriesController@delete');
    });

    /* Works routes */
    Route::group(['prefix' => 'works'], function() {
        Route::get('/', ['uses' => 'Admin\WorksController@index', 'as' => 'admin.works.index']);
        Route::get('/add', ['uses' => 'Admin\WorksController@add', 'as' => 'admin.works.add']);
        Route::get('/edit/{id}', ['uses' => 'Admin\WorksController@edit', 'as' => 'admin.works.edit']);
        Route::post('/delete', 'Admin\WorksController@delete');
        Route::post('/addwork', 'Admin\WorksController@addWork');
        Route::post('/editwork', 'Admin\WorksController@EditWork');
        Route::any('/deletephoto', 'Admin\WorksController@DeletePhoto');
        Route::post('/changeStatus', 'Admin\WorksController@ChangeStatus');
    });

});
