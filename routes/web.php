<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::get('/compete', 'ContestController@compete');
Route::post('/compete/{contestId}', 'ContestController@addCompete');

Route::middleware(['admin', 'auth'])->group(function () {
    Route::get('/admin/contests', 'AdminController@contests')->name('admin.contests');
    Route::get('/admin/users', 'AdminController@users')->name('admin.users');
    Route::post('/admin/contest/add', 'AdminController@createContest')->name('admin.contest.add');
    Route::get('admin/deleteUser/{id}', 'ContestController@deleteUser');
    Route::get('admin/importExport', 'ExcelController@importExport');
    Route::get('downloadExcel/{type}', 'ExcelController@downloadExcel');
    Route::post('importExcel', 'ExcelController@importExcel');
});