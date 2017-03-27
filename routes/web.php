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


Route::get('/', 'TriviaController@index');

Route::get('/play/', 'TriviaController@getGame');

//Route::get('/game/', 'TriviaController@processQuestion');
Route::post('/game/', 'TriviaController@processQuestion');

Route::any('/practice/{n?}', 'PracticeController@index');

// config(['app.timezone' => 'America/Chicago']);
// if (App::environment('local', 'staging')) {
if(config('app.env') == 'local') {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

Route::get('/debugbar', function() {

    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';

});
