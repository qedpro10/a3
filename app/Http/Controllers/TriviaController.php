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
    public function postGame(Request $request) {

        $this->validate($request, [
            'category' => 'required',
        ]);


        # Store the game category in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* category is not in the request.
        //$game = null;
        //$q_number = 1000;
        $category = $request->input('category', null);
        $elite = $request->has('elite');
        $gametype = $request->input('gametype', null);
        # Only play game if a category has been selected

        $questions = file_get_contents(database_path().'/questions.json');

        # Decode the book JSON data into an array
        # Nothing fancy here; just a built in PHP method
        $game = json_decode($questions, true);
        // initialize the # of correct answers
        $score = 0;
        // set the question number to the first question
        $qno = 1;

        // save this data in the session
        $request->session()->put('game', $game);
        $request->session()->put('qno', $qno);
        $request->session()->put('score', $score);

        return view('trivia.game')->with([
            'game' => $game,
            'qno' => $qno,
            'score' => $score,
        ]);
    }

    /**
    * POST
    * /game
    * Process the question and add to score
    */
    public function processQuestion(Request $request) {
        // get the game session data
        $game = $request->session()->get('game', 'default');
        $qno = $request->session()->get('qno', 'default');
        $score = $request->session()->get('score', 'default');


        $answer = $game[$qno]['answer'];
        dump($answer);

        // update the score
        if ($request->input('question') == $game[$qno]['answer']) {
            $score++;
            $request->session()->put('score', $score);
        }


        // check to see if the game is over
        if($qno == count($game)) {
            // game is complete
            // switch to gameover view
            return view('trivia.score')->with([
                'game' => $game,
                'qno' => $qno,
                'score' => $score,
            ]);
        }

        // increment the question number
        $qno++;
        // save the session data and go to the next question
        $request->session()->put('qno', $qno);

        return view('trivia.game')->with([
            'game' => $game,
            'qno' => $qno,
            'score' => $score,
        ]);
    }

    /**
    * POST
    * /score
    * Return to the play page
    */
    public function processScore(Request $request) {

        $request->session()->flush();

        return view('trivia.play');
    }
}
