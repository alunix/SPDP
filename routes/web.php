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

/* Pages that are shared across multiplse users */
// Route::get('programs/{program}', ['middleware' => 'type:pjk,penilai', function ($id) {
// 	//
	
// }]);

// Route::group(['middleware' => 'type:pjk,penilai'], function () {
// 	Route::get('programs/{program}','ProgramController@show')->name('program.show');
	
// });

// Route::get('programs/{program}', ['middleware' => 'type:pjk,penilai', 'uses' => 'ProgramController@show'],function($id){

// });

Route::get('programs/{program}', 'ProgramController@show')->middleware('type:pjk,penilai');




/*----------------------- Bahagian pihak fakulti ------------- */	
Route::group(['middleware' => 'SPDP\Http\Middleware\fakultiMiddleware'], function() {

	// Route::match(['get', 'post'], '/fakulti-dashboard/', 'HomeController@fakulti');
	// Route::match(['get', 'post'], '/program-baharu/', 'ProgramController@index','ProgramController@create');

	Route::get('/program-baharu', 'HomeController@fakulti')->name('fakulti.dashboard');

	/*----------------------- Fakulti nak create a new program pengajian ------------- */
	Route::get('/program-baharu', 'ProgramController@index')->name('program.page');
	Route::post('/program-baharu', 'ProgramController@store')->name('program.page.submit');

});

/*----------------------- Pusat Jaminan Kualiti(PJK) ------------- */	
// Route::group(['middleware' => 'SPDP\Http\Middleware\pjkMiddleware'], function() {

	Route::match(['get', 'post'], '/pjk-dashboard/', 'HomeController@pjk');
	
	/*----------------------- PJK menerima program pengajian daripada fakulti ------------- */	
	Route::match(['get', 'post'], '/pjk/program-baharu', 'ProgramController@showListProgramPengajian');
	
	
	/*----------------------- First penilaian program pengajian  ------------- */	
	// Route::get('/programs/senarai-penilaian','PenilaianController@index')->name('penilaian.show');
	// Route::get( '/programs/{program}', 'ProgramController@show')->name('program.show');	
	Route::get('/senarai-penilaian','PenilaianController@index')->name('penilaian.show');
	
	

	/*-----------------------Pelantikan penilai---------------------------------------------*/
	
	 Route::patch( '/programs/{program}/pelantikan-penilai', 'ProgramController@update')-> name('pelantikan_penilai.submit');
	 Route::get('/programs/{program}/pelantikan-penilai','ProgramController@edit')->name('pelantikan_penilai.show');
	
	
	/*-----------------------Senarai penilaian yang ongoing---------------------------------------------*/
	Route::get('senarai-penilaian-perakuan','PenilaianController@penilaianPJK_JPPA')->name('pjk.perakuan.show');



	/*-----------------------Lampiran perakuan PJK ---------------------------------------------*/
	Route::patch('/penilaian/{penilaian}','PenilaianController@updateLaporanPanel')->name('pjk.perakuan.submit');
	Route::get('/penilaian/{penilaian}','PenilaianController@editLaporanPanel')->name('pjk.perakuan.show');
	
	

	

	
	
	

	




// });

// Route::group(['middleware' => 'SPDP\Http\Middleware\penilaiMiddleware'], function() {

	Route::match(['get', 'post'], '/penilai-dashboard/', 'HomeController@penilai');
	Route::get('/panel-penilai/program-baharu','PenilaianController@showProgramPenilai');
	// Route::get( '/programs/{program}', 'ProgramController@show')->name('program.show');	
	// Route::get('/programs/{program}/kelulusan-permohonan','PenilaianController@edit')->name('penilai.laporan.show');
	// Route::patch('/programs/{program}/kelulusan-permohonan','PenilaianController@store')->name('penilai.laporan.submit');

	Route::patch('/programs/{program}/kelulusan-permohonan/{penilaian}','PenilaianController@update')->name('penilai.laporan.submit');
	Route::get('/programs/{program}/kelulusan-permohonan/{penilaian}','PenilaianController@edit')->name('penilai.laporan.show');

	
	

// });

// Route::group(['middleware' => 'SPDP\Http\Middleware\jppaMiddleware'], function(){

	Route::match(['get', 'post'], '/jppa-dashboard/', 'HomeController@jppa');

	/*-----------------------Lampiran perakuan JPPA ---------------------------------------------*/
	Route::patch('/jppa/penilaian/{penilaian}','PenilaianController@updatePerakuanPJK')->name('jppa.perakuan.submit');
	Route::get('/jppa/penilaian/{penilaian}','PenilaianController@editPerakuanPJK')->name('jppa.perakuan.show');

	Route::get('/jppa/permohonan-baharu','PenilaianController@editPerakuanPJK')->name('jppa.perakuan.show');


	


// });

Route::group(['middleware' => 'SPDP\Http\Middleware\senatMiddleware'], function(){

	Route::match(['get', 'post'], '/senat-dashboard/', 'HomeController@senat');

});






Route::get('/home', 'HomeController@index')->name('home');
