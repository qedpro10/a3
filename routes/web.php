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


//Route::any('/', function() {
//    return redirect()->action('TriviaController@getGame');
//});


Route::get('/', function () {
    return redirect('/play');
});

#### ROUTES ####
# Step 1 (Start of game)
Route::get('/play', 'TriviaController@index');
# POSTS to...

# Step 2 (Sets up game, then immediately redirects to Step 3)
Route::post('/play', 'TriviaController@postGame');

# Step 3 (Shows question; to be repeated for however many questions)
Route::get('/game', 'TriviaController@showQuestion');
# POSTS to...

# Step 4 (Checks the answer and redirects back to Step 3 for next question or Step 5 if done)
Route::post('/game/checkAnswer', 'TriviaController@checkAnswer');

# Step 5 (End of game)
Route::get('/score', 'TriviaController@showScore');


Route::post('/score', 'TriviaController@processScore');

/*
Route::get('/play', 'TriviaController@index');

Route::post('/play', 'TriviaController@postGame');

// redirect to this once the play page has been engaged
Route::get('/game', 'TriviaController@viewGame');


//
Route::post('/game/checkAnswer', 'TriviaController@processQuestion');

//Route::get('/score', 'TriviaController@processScore');
Route::post('/score', 'TriviaController@processScore');
*/

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
