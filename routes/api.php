<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->group(function () {

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/get_user_info', 'UserController@getUserInfo')->name('api.user_info');
    /* Fakulti */
    Route::get('/senarai-permohonan-dihantar', 'PermohonanController@api_permohonanDihantar')->name('api.permohonan.dihantar');
    Route::post('/permohonan/submit', 'PermohonanController@store')->name('api.permohonan.submit');
    Route::get('/permohonan/{id}', 'PermohonanController@show')->name('api.permohonan.show');

    /*----------------------- Senarai dokumen permohonan ------------- */
    Route::get('/senarai-dokumen/{permohonan}', 'DokumenPermohonanController@show')->name('api.dokumen.dihantar');
    Route::get('/senarai-kemajuan/{permohonan}', 'KemajuanPermohonanController@show')->name('api.kemajuan.index');
    Route::get('/senarai-laporan/{permohonan}', 'LaporanController@show')->name('api.laporan.index');
    Route::get('/senarai-laporan-dokumen/{dokumen_id}', 'LaporanController@laporanDokumen')->name('api.laporan.dokumen');
    Route::get('/dokumen/{file_link}', 'DokumenPermohonanController@downloadDokumen')->name('api.dokumen.download');
    /*----------------------- PJK menerima program pengajian daripada fakulti ------------- */
    Route::get('/senarai-permohonan-baharu', 'PermohonanController@api_showListPermohonanBaharu')->name('api.senaraiPermohonan');
    Route::get('/senarai-perakuan', 'PermohonanController@senaraiPerakuan')->name('api.senaraiPerakuan');
    Route::get('/dashboard', 'HomeController@index')->middleware('auth')->name('home');
    Route::get('/senarai-penilaian', 'PenilaianPanelController@index')->name('penilaian.show');
    Route::get('/users', 'UserController@getUsers');
    Route::get('/fakultis', 'FakultiController@getFakultis');
    Route::post('/user/store', 'UserController@store')->name('register.panel_penilai.submit');
    Route::get('/user/{id}/edit', 'UserController@edit')->name('api.user.edit');
    Route::post('/user/{id}/update', 'UserController@update')->name('api.user.update');
    Route::get('/user/search/{query}', 'UserController@searchUsers')->name('api.user.search');
    Route::get('/senarai-panel-penilai', 'UserController@getPanelPenilai')->name('api.penilai.all');
    Route::get('/panel-penilai/search/{query}', 'UserController@searchPenilai')->name('api.user.search');
    // 	/*-----------------------Pelantikan penilai---------------------------------------------*/
    Route::patch('/{id}/pelantikan-penilai', 'PermohonanController@pelantikanPenilaiSubmit')->name('pelantikan_penilai.submit');
    //Upload laporan
    Route::post('/upload-laporan/{id}', 'LaporanController@store')->name('api.laporan.store');
    Route::post('/muat-naik-penambahbaikkan/{permohonan}', 'DokumenPermohonanController@uploadPenambahbaikkan')->name('dokumenPermohonan.penambahbaikkan.submit');
    Route::get('/analytics', 'ChartController@analitik')->name('api.analytics');
    Route::get('/settings', 'ChartController@analitik')->name('api.analytics');
});
