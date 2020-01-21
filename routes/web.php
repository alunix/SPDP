<?php
Auth::routes();
Route::group(['prefix' => 'api', 'middleware' => 'auth:web'], function () {

});

Route::get('{any}', function () {
	return view('layouts.app');
})->where('any', '.*')->middleware('auth');