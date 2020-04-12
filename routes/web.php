<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/currentUser', 'HomeController@currentUser');

Auth::routes();

Route::resource('/rooms', 'RoomsController');

Route::resource('/rooms/{room}/messages', 'MessagesController');