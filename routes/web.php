<?php
Auth::routes();

Route::get('{any}', function () {
	return view('layouts.app');
})->where('any', '.*')->middleware('auth');