<?php

Route::view('/', 'welcome');

// resource routes
Route::resource('forms','FormController');
