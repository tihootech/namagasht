<?php

Route::view('/', 'welcome');

// resource routes
Route::resource('forms','FormController')->except(['show','create']);
Route::get('form/question_positions/{form}', 'FormController@question_positions');
Route::post('questions', 'FormController@question');
Route::get('questions/{qid}/delete', 'FormController@delete_question');
Route::get('form/{form_uid}/{question?}', 'FormController@show_to_fill');
Route::post('form/fill/{form}/{question}', 'FormController@fill');
Route::get('form/{form}/action/{action}/{page?}', 'FormController@display_action');
Route::post('form/delete_filler', 'FormController@delete_filler');
Route::post('form/point_rule/{question}', 'FormController@point_rule');
