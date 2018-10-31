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




Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('/dashboard'); // Redirect to dashboard/home(Same page)
Route::get('/', 'HomeController@index')->middleware('auth'); //Redirect index page to login if not authenticated and will return homepage if authenticated.


/*........................................Start middleware.............................*/
Route::group(['middleware' => 'SPDP\Http\Middleware\fakultiMiddleware'], function() {

	// Route::match(['get', 'post'], '/fakulti-dashboard/', 'HomeController@fakulti');
	// Route::match(['get', 'post'], '/program-baharu/', 'ProgramController@index','ProgramController@create');

	Route::get('/program-baharu', 'HomeController@fakulti')->name('fakulti.dashboard');

	/*----------------------- Fakulti nak create a new program pengajian ------------- */
	Route::get('/program-baharu', 'ProgramController@index')->name('program.page');
	Route::post('/program-baharu', 'ProgramController@store')->name('program.page.submit');

});

Route::group(['middleware' => 'SPDP\Http\Middleware\pjkMiddleware'], function() {

	Route::match(['get', 'post'], '/pjk-dashboard/', 'HomeController@pjk');
	
	/*----------------------- PJK mahu melihat program pengajian daripada fakulti ------------- */

	//Route::get('/pjk/program-baharu', 'ProgramController@showListProgramPengajian')->name('pjk_program.index');
	Route::match(['get', 'post'], '/pjk/program-baharu', 'ProgramController@showListProgramPengajian');
	Route::match(['get', 'post'], '/programs/{program}', 'ProgramController@show');

});

Route::group(['middleware' => 'SPDP\Http\Middleware\penilaiMiddleware'], function() {

	Route::match(['get', 'post'], '/penilai-dashboard/', 'HomeController@penilai');

});

Route::group(['middleware' => 'SPDP\Http\Middleware\jppaMiddleware'], function(){

	Route::match(['get', 'post'], '/jppa-dashboard/', 'HomeController@jppa');


});

Route::group(['middleware' => 'SPDP\Http\Middleware\senatMiddleware'], function(){

	Route::match(['get', 'post'], '/senat-dashboard/', 'HomeController@senat');

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
