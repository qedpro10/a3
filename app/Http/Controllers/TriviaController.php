<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TriviaController extends Controller
{
    /**
	* GET
    * /
	*/
    public function index(Request $request) {

        return view('trivia.play')->with([
            'category' => $request->input('category'),
            'elite' => $request->has('elite'),
            'gametype' => $request->input('gametype'),
        ]);
    }
    /**
    * GET
    * /play
    */
    public function getGame(Request $request) {

        $this->validate($request, [
            'category' => 'required',
        ]);
        # Store the game category in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* category is not in the request.
        $game = null;
        $q_number = 1000;
        $category = $request->input('category', null);
        $elite = $request->has('elite');
        $gametype = $request->input('gametype', null);
        # Only play game if a category has been selected

        $questions = file_get_contents(database_path().'/questions.json');

        # Decode the book JSON data into an array
        # Nothing fancy here; just a built in PHP method
        $game = json_decode($questions, true);

        $q_number = count($game);
        $qno = 1;
        //dump($q_number);

        return view('trivia.game')->with([
            'q_number' => $q_number,
            'game' => $game,
            'qno' => $qno,
        ]);
    }

    /**
    * POST
    * /game
    * Process the question and add to score
    */
    public function processQuestion(Request $request) {
        dump($request);
        // how to get this information
        return view('trivia.game')->with([
            'q_number' => $q_number,
            'game' => $game,
            'qno' => $qno,
        ]);
    }
}
