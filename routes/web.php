<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'HomeController@index');
Route::get('/{any}', 'HomeController@index');
Route::get('/{any}/{any1}', 'HomeController@index');
Route::any('/broadcasting/auth', '\Illuminate\Broadcasting\BroadcastController@authenticate');
