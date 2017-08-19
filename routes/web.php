<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::get('/admin/contests', 'AdminController@contests')->name('admin.contests');
Route::get('/admin/users', 'AdminController@users')->name('admin.users');
Route::post('/admin/contest/add', 'AdminController@createContest')->name('admin.contest.add');

Route::get('/compete/{contestId}', 'ContestController@compete');
Route::post('/compete/{contestId}/add', 'ContestController@addCompete');