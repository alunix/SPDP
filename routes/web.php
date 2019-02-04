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










/*----------------------- Bahagian pihak fakulti ------------- */	
Route::group(['middleware' => 'SPDP\Http\Middleware\fakultiMiddleware'], function() {

	// Route::match(['get', 'post'], '/fakulti-dashboard/', 'HomeController@fakulti');
	// Route::match(['get', 'post'], '/program-baharu/', 'ProgramController@index','ProgramController@create');

	//Route::get('/program-baharu', 'HomeController@fakulti')->name('fakulti.dashboard');
	// Route::get('/permohonan-baru', 'FakultiController@permohonanBaru')->name('fakulti.dashboard');
	

	/*----------------------- Fakulti nak create a new program pengajian ------------- */
	Route::get('/permohonan-baharu', 'PermohonanController@index')->name('permohonan.index');
	Route::post('/permohonan-baharu', 'PermohonanController@store')->name('permohonan.index.submit');

	/*----------------------- Fakulti nak semak permohonan yang dihantar ------------- */
	Route::get('/senarai-permohonan-dihantar', 'PermohonanController@permohonanDihantar')->name('permohonan.dihantar');

	/*----------------------- Fakulti nak mengemas kini tetapan profil ------------- */
	Route::get('/settings', 'UserController@edit')->name('settings');
	Route::post('/settings', 'UserController@update')->name('settings.submit');

	Route::get('/kemajuan-permohonan/{permohonan}', 'KemajuanPermohonanController@show')->name('fakulti.kemajuanPermohonan');
	






	

});

/*----------------------- Pusat Jaminan Kualiti(PJK) ------------- */	
// Route::group(['middleware' => 'SPDP\Http\Middleware\pjkMiddleware'], function() {

	Route::match(['get', 'post'], '/pjk-dashboard/', 'HomeController@pjk');
	
	/*----------------------- PJK menerima program pengajian daripada fakulti ------------- */	
	Route::match(['get', 'post'], '/pjk/permohonan-baharu', 'PermohonanController@showListPermohonanBaharu')->name('pjk.list.permohonanBaharu');
	
	
	/*----------------------- First penilaian program pengajian  ------------- */	
	// Route::get('/programs/senarai-penilaian','PenilaianController@index')->name('penilaian.show');
	// Route::get( '/programs/{program}', 'PermohonanController@show')->name('program.show');	
	Route::get('/senarai-penilaian','PenilaianController@index')->middleware('role:pjk','auth')->name('penilaian.show');
	
	/*-----------------------Daftar penilai---------------------------------------------*/
	Route::get('/pendaftaran-panel-penilai', 'PenilaianController@create_panel_penilai')->name('register.panel_penilai.show');
	Route::post('/pendaftaran-panel-penilai', 'PenilaianController@store_panel_penilai')->name('register.panel_penilai.submit');

	/*-----------------------PJK Lulus permohonan dan ingin memuat naik perakuan tanpa panel penilai---------------------------------------------*/
	Route::get( '/permohonan/{permohonan}/perakuan-pjk', 'PenilaianController@showPerakuanPjk')-> name('pjk.perakuanLulus.show');
	Route::patch('/permohonan/{permohonan}/perakuan-pjk','PenilaianController@uploadPerakuanPjk')->name('pjk.perakuanLulus.submit');

	/*-----------------------Pelantikan penilai---------------------------------------------*/
	
	 Route::patch( '/permohonan/{permohonan}/pelantikan-penilai', 'PermohonanController@update')-> name('pelantikan_penilai.submit');
	 Route::get('/permohonan/{permohonan}/pelantikan-penilai','PermohonanController@edit')->name('pelantikan_penilai.show');

	 Route::get('permohonan/{permohonan}', 'PermohonanController@show')->middleware('role:pjk,penilai')->name('view-permohonan-baharu');

	 Route::patch('permohonan/{permohonan}/tidak-dilulus', 'PermohonanController@storePermohonanTidakDilulus')->name('pjk.permohonanTidakDilulus');	
	 Route::get('permohonan/{permohonan}/tidak-dilulus', 'PermohonanController@permohonanTidakDilulus')->name('pjk.permohonanTidakDilulus.submit');	
	
	
	
	/*-----------------------Senarai penilaian yang ongoing---------------------------------------------*/
	Route::get('senarai-penilaian-perakuan','PenilaianController@penilaianPJK_JPPA')->name('pjk.senarai_perakuan.show');



	/*-----------------------Lampiran perakuan PJK ---------------------------------------------*/
	Route::patch('/penilaian/{penilaian}','PenilaianController@updateLaporanPanel')->name('pjk.perakuan.submit');
	Route::get('/penilaian/{penilaian}','PenilaianController@editLaporanPanel')->name('pjk.perakuan.show');
	
	

	

	
	
	

	




// });

// Route::group(['middleware' => 'SPDP\Http\Middleware\penilaiMiddleware'], function() {

	Route::match(['get', 'post'], '/penilai-dashboard/', 'HomeController@penilai');
	Route::get('/panel-penilai/permohonan-baharu','PenilaianController@showPermohonanPenilai')->name('penilai.permohonan-baharu');
	// Route::get( '/programs/{program}', 'ProgramController@show')->name('program.show');	
	// Route::get('/programs/{program}/kelulusan-permohonan','PenilaianController@edit')->name('penilai.laporan.show');
	// Route::patch('/programs/{program}/kelulusan-permohonan','PenilaianController@store')->name('penilai.laporan.submit');

	Route::patch('/permohonans/{permohonan}/kelulusan-permohonan/{penilaian}','PenilaianController@update')->name('penilai.laporan.submit');
	Route::get('/permohonans/{permohonan}/kelulusan-permohonan/{penilaian}','PenilaianController@edit')->name('penilai.laporan.show');

	
	

// });

// Route::group(['middleware' => 'SPDP\Http\Middleware\jppaMiddleware'], function(){

	Route::match(['get', 'post'], '/jppa-dashboard/', 'HomeController@jppa');

	/*-----------------------Lampiran perakuan JPPA ---------------------------------------------*/
	Route::patch('/jppa/penilaian/{penilaian}','PenilaianController@updatePerakuanPJK')->name('jppa.perakuan.submit');
	Route::get('/jppa/penilaian/{penilaian}','PenilaianController@editPerakuanPJK')->name('jppa.perakuan.show');

	


	


// });

Route::group(['middleware' => 'SPDP\Http\Middleware\senatMiddleware'], function(){

	Route::match(['get', 'post'], '/senat-dashboard/', 'HomeController@senat');

});






Route::get('/home', 'HomeController@index')->name('home');
