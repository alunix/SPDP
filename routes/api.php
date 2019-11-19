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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'auth:api'], function() {
//     Route::get('/permohonan_dihantar','PermohonanController@api_permohonanDihantar')->name('api.permohonan.dihantar');
// });

Route::middleware('auth:api')->group(function () {
    // Route::get('/permohonan_dihantar','PermohonanController@api_permohonanDihantar')->name('api.permohonan.dihantar');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
Route::post('/login', 'Auth\API\AuthController@login')->name('api.login');


