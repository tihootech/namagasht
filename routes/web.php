<?php

Route::view('/', 'welcome');

// resource routes
Route::resource('forms','FormController');
Route::post('questions', 'FormController@question');
Route::get('questions/{qid}/delete', 'FormController@delete_question');
