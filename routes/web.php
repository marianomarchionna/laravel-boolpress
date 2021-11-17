<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotta che gestisce la homepage visibile agli utenti
Route::get('/', 'HomeController@index')->name('index');

//Rotta che gestirà i post per l'utente generico
Route::get('/posts', 'PostController@index')->name('index');
Route::get('/posts/{slug}', 'PostController@show')->name('show');

// Serie di rotte che gestiscono tutto il meccanismo di autenticazione
Auth::routes();

// Serie di rotte che gestiscono il backoffice
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')
    ->group(function() {
        //pagina di atterraggio dopo il login (con il prefix, l'url è /admin)
        Route::get('/', 'HomeController@index')->name('index');

        Route::resource('/posts', 'PostController');
        Route::resource('/categories', 'CategoryController');
        Route::resource('/tags', 'TagController');
        Route::resource('/users', 'UserController');

        //rotta per cancellazione immagine 
        Route::get('/deleteImgage', 'PostController@deleteImage')->name('deleteImage');
    });
