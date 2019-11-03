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
Route::post('/search', 'SearchController@search')->name('search');
/*----------------------- API REST VUE ------------- */
Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
	Route::get('/role', 'UserController@getRole')->name('api.role');
	/* Fakulti */
	Route::get('/permohonan_dihantar', 'PermohonanController@api_permohonanDihantar')->name('api.permohonan.dihantar');
	Route::post('/permohonan_submit', 'PermohonanController@store')->name('api.permohonan.submit');
	Route::get('/permohonan/{permohonan}', 'PermohonanController@show')->name('view-permohonan-baharu');

	/*----------------------- Senarai dokumen permohonan ------------- */
	Route::get('/senarai-dokumen/{permohonan}', 'DokumenPermohonanController@show')->name('api.dokumen.dihantar');
	Route::get('/senarai-kemajuan/{permohonan}', 'KemajuanPermohonanController@show')->name('api.kemajuan.index');
	Route::get('/senarai-laporan/{permohonan}', 'LaporanController@show')->name('api.laporan.index');
	Route::get('/dokumen/{file_link}', 'DokumenPermohonanController@downloadDokumen')->name('api.dokumen.download');
	/*----------------------- PJK menerima program pengajian daripada fakulti ------------- */
	Route::get('/senarai-permohonan-baharu', 'PermohonanController@api_showListPermohonanBaharu')->name('api.senaraiPermohonan');
	Route::get('/senarai-perakuan', 'PermohonanController@senaraiPerakuan')->name('api.senaraiPerakuan');
	Route::get('/dashboard', 'HomeController@index')->middleware('auth')->name('home');
	Route::get('/senarai-penilaian', 'PenilaianPanelController@index')->name('penilaian.show');
});

// /*-----------------------Fakulti------------- */
// Route::group(['middleware' => 'auth'], function () {
// 	/*----------------------- Fakulti nak mengemas kini tetapan profil ------------- */
// 	Route::get('/settings', 'UserController@edit')->name('settings');
// 	Route::post('/settings', 'UserController@update')->name('settings.submit');

// 	/*----------------------- Fakulti nak memuat naik laporan---------------------------- */
// 	Route::get('/muat-naik-penambahbaikkan/{permohonan}', 'DokumenPermohonanController@showPenambahbaikkan')->name('dokumenPermohonan.penambahbaikkan.show');
// 	Route::post('/muat-naik-penambahbaikkan/{permohonan}', 'DokumenPermohonanController@uploadPenambahbaikkan')->name('dokumenPermohonan.penambahbaikkan.submit');

// 	/*----------------------- Fakulti lihat laporan dokumen permohnan---------------------------- */
// 	Route::get('/senarai-laporan/{dokumen_permohonan}', 'LaporanController@show')->name('senaraiLaporan.show');
// });

// /*----------------------- Pusat Jaminan Kualiti(PJK) ------------- */
// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('/tetapan-aliran-kerja', 'TetapanAliranKerjaController@index')->name('aliranKerja.settings.show');
// 	Route::post('/tetapan-aliran-kerja', 'TetapanAliranKerjaController@update')->name('aliranKerja.settings.submit');

// 	/*----------------------- PJK menerima program pengajian daripada fakulti ------------- */
// 	Route::match(['get', 'post'], '/senarai-permohonan-baharu', 'PermohonanController@showListPermohonanBaharu')->middleware('auth')->name('senaraiPermohonanBaharu');

// 	/*----------------------- First penilaian program pengajian  ------------- */
// 	Route::get('/senarai-penilaian', 'PenilaianPanelController@index')->name('penilaian.show');

// 	/*-----------------------Daftar penilai---------------------------------------------*/
// 	Route::get('/pendaftaran-pengguna', 'UserController@create_pengguna')->name('register.panel_penilai.show');
// 	Route::post('/pendaftaran-pengguna', 'UserController@store_pengguna')->name('register.panel_penilai.submit');

// 	/*-----------------------Lampiran perakuan PJK ---------------------------------------------*/
// 	Route::patch('/lampiran-perakuan-pjk/{permohonan}', 'PenilaianController@uploadPerakuanPjk')->name('pjk.perakuan.submit');
// 	Route::get('/lampiran-perakuan-pjk/{permohonan}', 'PenilaianController@showPerakuanPjk')->name('pjk.perakuan.show');

// 	/*-----------------------Pelantikan penilai---------------------------------------------*/
// 	Route::patch('/permohonan/{permohonan}/pelantikan-penilai', 'PermohonanController@pelantikanPenilaiSubmit')->name('pelantikan_penilai.submit');
// 	Route::get('/permohonan/{permohonan}/pelantikan-penilai', 'PermohonanController@showPelantikanPenilai')->name('pelantikan_penilai.show');

// 	Route::get('permohonan/{permohonan}', 'PermohonanController@show')->name('view-permohonan-baharu');

// 	Route::patch('permohonan/{permohonan}/penambahbaikkan', 'PermohonanController@storePermohonanTidakDilulus')->name('laporan.permohonanTidakDilulus');
// 	Route::get('permohonan/{permohonan}/penambahbaikkan', 'PermohonanController@permohonanTidakDilulus')->name('laporan.permohonanTidakDilulus.submit');

// 	/*-----------------------Senarai penilaian yang ongoing---------------------------------------------*/
// 	Route::get('senarai-perakuan-permohonan', 'PermohonanController@senaraiPerakuan')->name('senaraiPerakuan.show');

// 	//Analitik permohonan
// 	Route::get('/analitik-permohonan', 'PermohonanChartController@annual')->name('analitik.permohonan');
// 	Route::post('/analitik-permohonan', 'PermohonanChartController@annual')->name('analitik.permohonan.submit');
// 	Route::get('/analitik-permohonan-dashboard', 'PermohonanChartController@dashboard')->name('analitik.permohonan.dashboard');
// 	Route::get('/analitik-testing', 'PermohonanChartController@testing')->name('analitik.permohonan.testing');
// 	Route::get('/analitik/fakulti/{fakulti_id}/{year_report}', 'FakultiController@analitik')->name('analitik.fakulti');
// });

// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('/panel-penilai/permohonan-baharu', 'PenilaianController@showPermohonanPenilai')->name('penilai.permohonan-baharu');
// 	Route::patch('/permohonans/{permohonan}/kelulusan-permohonan/', 'PenilaianController@uploadLaporanPenilai')->name('penilai.laporan.submit');
// 	Route::get('/permohonans/{permohonan}/kelulusan-permohonan/', 'PenilaianController@showLaporanPenilai')->name('penilai.laporan.show');
// });

// Route::group(['middleware' => 'auth'], function () {
// 	/*-----------------------Lampiran perakuan JPPA ---------------------------------------------*/
// 	Route::patch('/jppa/permohonan/{permohonan}/lampiran-perakuan', 'PenilaianController@uploadPerakuanJppa')->name('jppa.perakuan.submit');
// 	Route::get('/jppa/permohonan/{permohonan}/lampiran-perakuan', 'PenilaianController@showPerakuanJppa')->name('jppa.perakuan.show');

// 	/*-----------------------Lampiran perakuan Senat---------------------------------------------*/
// 	Route::patch('/permohonan/{permohonan}/lampiran-perakuan-senat', 'PenilaianController@uploadPerakuanJppa')->name('senat.perakuan.submit');
// 	Route::get('/permohonan/{permohonan}/lampiran-perakuan-senat', 'PenilaianController@showPerakuanJppa')->name('senat.perakuan.show');
// });

Route::get('{any}', function () {
	return view('layouts/app');
})->where('any', '.*')->middleware('auth');
