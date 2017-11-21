<?php


Auth::routes();
Route::get('search', 'PagesController@search');
Route::get('/', 'PagesController@home')->name('home');
Route::post('/profile/update', 'ProfileController@update');
Route::post('/profile/invite', 'ProfileController@invite');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile_edit');
