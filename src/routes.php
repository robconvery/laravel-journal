<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/laravel-journal/entry/{date}', 'Robconvery\LaravelJournal\Controllers\JournalController@entry')
        ->where('date', '[0-9]{4}\-[0-9]{2}\-[0-9]{2}')
        ->name('laravel-journal-entry');

    Route::get('/laravel-journal/entry/{id}/edit', 'Robconvery\LaravelJournal\Controllers\JournalController@edit')
        ->where('id', '[0-9]+')
        ->name('laravel-journal-edit');

    Route::post('/laravel-journal/entry/{id}/store', 'Robconvery\LaravelJournal\Controllers\JournalController@store')
        ->where('id', '[0-9]+')
        ->name('laravel-journal-store');

    Route::get('/laravel-journal/entry/new', 'Robconvery\LaravelJournal\Controllers\JournalController@new')
        ->name('laravel-journal-new');

    Route::post('/laravel-journal/entry/create', 'Robconvery\LaravelJournal\Controllers\JournalController@create')
        ->name('laravel-journal-create');

    Route::get('/laravel-journal', 'Robconvery\LaravelJournal\Controllers\JournalController@all')
        ->name('laravel-journal-all');

});
