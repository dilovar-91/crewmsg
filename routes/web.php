<?php

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
Route::get('{all}', function () {
    //return file_get_contents(public_path('_nuxt/index.html'));
    return abort(404);
})->where('all', '^(?!videos).*$');
