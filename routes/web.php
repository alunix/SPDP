<?php
Auth::routes();
// Route::post('/search', 'SearchController@search')->name('search');
Route::get('api/is_user_authenticated', 'UserController@isUserAuthenticated')->name('api.isUserAuthenticated');
Route::get('{any}', function () {
	return view('layouts.app');
})->where('any', '.*')->middleware('auth');
