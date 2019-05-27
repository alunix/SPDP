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
Route::get('/show-testing', 'PermohonanController@testing_show'); // Redirect to dashboard/home(Same page)

Route::get('/pusher', function(){
	return view('pusher');
});

// Route::post('/search',function(){
//     $q = Input::get ( 'input-search' );
// 	$user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
	
// 	$msg = [
// 		'error' => 'Carian tidak dapat mencari '.$q,
// 	   ];

//     if(count($user) > 0)
//         return view('search-result')->withDetails($user)->withQuery ( $q );
//     else return view ('search-result')->with($msg);
// });

Route::post('/search','SearchController@search')->name('search');
Route::get('/dashboard', 'HomeController@index')->name('/dashboard')->middleware('auth'); // Redirect to dashboard/home(Same page)
Route::get('/', 'HomeController@index')->middleware('auth')->name('home'); //Redirect index page to login if not authenticated and will return homepage if authenticated.
Route::get('/notifikasi', 'NotificationController@index')->middleware('auth')->name('notifications.index'); //Redirect index page to login if not authenticated and will return homepage if authenticated.

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
Route::group(['middleware' => 'SPDP\Http\Middleware\fakultiMiddleware','middleware' => 'auth'], function() {

	// Route::match(['get', 'post'], '/fakulti-dashboard/', 'HomeController@fakulti');
	// Route::match(['get', 'post'], '/program-baharu/', 'ProgramController@index','ProgramController@create');

	//Route::get('/program-baharu', 'HomeController@fakulti')->name('fakulti.dashboard');
	// Route::get('/permohonan-baru', 'FakultiController@permohonanBaru')->name('fakulti.dashboard');
	

	/*----------------------- Fakulti nak create a new program pengajian ------------- */
	Route::get('/permohonan-baharu', 'PermohonanController@index')->name('permohonan.index');
	Route::post('/permohonan-baharu', 'PermohonanController@store')->name('permohonan.index.submit');

	/*----------------------- Fakulti nak semak permohonan yang dihantar ------------- */
	Route::get('/senarai-permohonan-dihantar', 'PermohonanController@permohonanDihantar')->name('permohonan.dihantar');
	
	/*----------------------- Senarai dokumen permohonan ------------- */
	Route::get('/senarai-dokumen-permohonan/{permohonan}', 'DokumenPermohonanController@show')->name('dokumenPermohonan.dihantar');

	/*----------------------- Fakulti nak mengemas kini tetapan profil ------------- */
	Route::get('/settings', 'UserController@edit')->name('settings');
	Route::post('/settings', 'UserController@update')->name('settings.submit');

	Route::get('/kemajuan-permohonan/{permohonan}', 'KemajuanPermohonanController@show')->name('fakulti.kemajuanPermohonan');

	/*----------------------- Fakulti nak memuat naik laporan---------------------------- */
	Route::get('/muat-naik-penambahbaikkan/{permohonan}', 'DokumenPermohonanController@showPenambahbaikkan')->name('dokumenPermohonan.penambahbaikkan.show');
	Route::post('/muat-naik-penambahbaikkan/{permohonan}', 'DokumenPermohonanController@uploadPenambahbaikkan')->name('dokumenPermohonan.penambahbaikkan.submit');

	/*----------------------- Fakulti lihat laporan dokumen permohnan---------------------------- */
	Route::get('/senarai-laporan/{dokumen_permohonan}', 'LaporanController@show')->name('senaraiLaporan.show');

});

/*----------------------- Pusat Jaminan Kualiti(PJK) ------------- */	
// Route::group(['middleware' => 'SPDP\Http\Middleware\pjkMiddleware'], function() {

	Route::match(['get', 'post'], '/pjk-dashboard/', 'HomeController@pjk');

	Route::get('/tetapan-aliran-kerja','TetapanAliranKerjaController@index')->name('aliranKerja.settings.show');
	Route::post('/tetapan-aliran-kerja','TetapanAliranKerjaController@update')->name('aliranKerja.settings.submit');
	
	/*----------------------- PJK menerima program pengajian daripada fakulti ------------- */	
	Route::match(['get', 'post'], '/senarai-permohonan-baharu', 'PermohonanController@showListPermohonanBaharu')->middleware('auth')->name('senaraiPermohonanBaharu');
	
	
	/*----------------------- First penilaian program pengajian  ------------- */	

	Route::get('/senarai-penilaian','PenilaianController@index')->name('penilaian.show');
	
	/*-----------------------Daftar penilai---------------------------------------------*/
	Route::get('/pendaftaran-pengguna', 'PenilaianController@create_panel_penilai')->name('register.panel_penilai.show');
	Route::post('/pendaftaran-pengguna', 'PenilaianController@store_panel_penilai')->name('register.panel_penilai.submit');

	// /*-----------------------PJK Lulus permohonan dan ingin memuat naik perakuan tanpa panel penilai---------------------------------------------*/
	// Route::get( '/permohonan/{permohonan}/perakuan-pjk', 'PenilaianController@showPerakuanPjk')-> name('pjk.perakuanLulus.show');
	// Route::patch('/permohonan/{permohonan}/perakuan-pjk','PenilaianController@uploadPerakuanPjk')->name('pjk.perakuanLulus.submit');

	/*-----------------------Lampiran perakuan PJK ---------------------------------------------*/
	Route::patch('/penilaian/{permohonan}','PenilaianController@uploadPerakuanPjk')->name('pjk.perakuan.submit');
	Route::get('/penilaian/{permohonan}','PenilaianController@showPerakuanPjk')->name('pjk.perakuan.show');

	/*-----------------------Pelantikan penilai---------------------------------------------*/
	
	 Route::patch( '/permohonan/{permohonan}/pelantikan-penilai', 'PermohonanController@pelantikanPenilaiSubmit')-> name('pelantikan_penilai.submit');
	 Route::get('/permohonan/{permohonan}/pelantikan-penilai','PermohonanController@showPelantikanPenilai')->middleware('auth')->name('pelantikan_penilai.show');

	 Route::get('permohonan/{permohonan}', 'PermohonanController@show')->middleware('auth')->name('view-permohonan-baharu');

	 Route::patch('permohonan/{permohonan}/penambahbaikkan', 'PermohonanController@storePermohonanTidakDilulus')->name('laporan.permohonanTidakDilulus');	
	 Route::get('permohonan/{permohonan}/penambahbaikkan', 'PermohonanController@permohonanTidakDilulus')->name('laporan.permohonanTidakDilulus.submit');	
	
	/*-----------------------Senarai penilaian yang ongoing---------------------------------------------*/
	Route::get('senarai-perakuan-permohonan','PermohonanController@senaraiPerakuan')->name('senaraiPerakuan.show');

	//Analitik permohonan
	Route::get('/analitik-permohonan','PermohonanChartController@annual')->middleware('auth')->name('analitik.permohonan');
	Route::post('/analitik-permohonan','PermohonanChartController@annual')->middleware('auth')->name('analitik.permohonan.submit');
	Route::get('/analitik-permohonan-dashboard','PermohonanChartController@dashboard')->middleware('auth')->name('analitik.permohonan.dashboard');

	Route::get('/analitik-testing','PermohonanChartController@testing')->name('analitik.permohonan.testing');
	Route::get('/analitik/fakulti/{fakulti_id}','FakultiController@analitik')->name('analitik.fakulti');


// });

// Route::group(['middleware' => 'SPDP\Http\Middleware\penilaiMiddleware'], function() {

	Route::match(['get', 'post'], '/penilai-dashboard/', 'HomeController@penilai');
	Route::get('/panel-penilai/permohonan-baharu','PenilaianController@showPermohonanPenilai')->name('penilai.permohonan-baharu');
	// Route::get( '/programs/{program}', 'ProgramController@show')->name('program.show');	
	// Route::get('/programs/{program}/kelulusan-permohonan','PenilaianController@edit')->name('penilai.laporan.show');
	// Route::patch('/programs/{program}/kelulusan-permohonan','PenilaianController@store')->name('penilai.laporan.submit');

	Route::patch('/permohonans/{permohonan}/kelulusan-permohonan/','PenilaianController@uploadLaporanPenilai')->name('penilai.laporan.submit');
	Route::get('/permohonans/{permohonan}/kelulusan-permohonan/','PenilaianController@showLaporanPenilai')->name('penilai.laporan.show');

// });

// Route::group(['middleware' => 'SPDP\Http\Middleware\jppaMiddleware'], function(){

	/*-----------------------Lampiran perakuan JPPA ---------------------------------------------*/
	Route::patch('/jppa/permohonan/{permohonan}/lampiran-perakuan','PenilaianController@uploadPerakuanJppa')->name('jppa.perakuan.submit');
	Route::get('/jppa/permohonan/{permohonan}/lampiran-perakuan','PenilaianController@showPerakuanJppa')->name('jppa.perakuan.show');

	/*-----------------------Lampiran perakuan Senat---------------------------------------------*/
	Route::patch('/permohonan/{permohonan}/lampiran-perakuan-senat','PenilaianController@uploadPerakuanJppa')->name('senat.perakuan.submit');
	Route::get('/permohonan/{permohonan}/lampiran-perakuan-senat','PenilaianController@showPerakuanJppa')->name('senat.perakuan.show');

// });

Route::group(['middleware' => 'SPDP\Http\Middleware\senatMiddleware'], function(){

	Route::match(['get', 'post'], '/senat-dashboard/', 'HomeController@senat');

});






