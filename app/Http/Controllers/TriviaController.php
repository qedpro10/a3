<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Game;


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

        # Only play game if a category has been selected
        $this->validate($request, [
            'category' => 'required',
        ]);


        # Store the game category in a variable for easy access
        $category = $request->input('category');
        $elite = $request->has('elite');
        $gametype = $request->input('gametype', null);
        dump($gametype);

        $triviaGame = new Game($category, $elite, 10);
        $game = $triviaGame->getGame();

        $displayLogo = $triviaGame->getLogo();
        // initialize the game parameters score and question number (qno)
        $score = 0;
        $qno = 1;

        // save this data in the session
        $request->session()->put('game', $game);
        $request->session()->put('qno', $qno);
        $request->session()->put('score', $score);
        $request->session()->put('logo', $displayLogo);
        $request->session()->put('gametype', $gametype);

        // get the question
        $question = $game[$qno];

        // get the start time
        $startTime = time();
        $request->session()->put('startTime', $startTime);

        return view('trivia.game')->with([
            'question' => $question,
            'qno' => $qno,
            'score' => $score,
            'logo' => $displayLogo,
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
        $displayLogo = $request->session()->get('logo', 'default');


        $answer = $game[$qno]['answer'];

        // update the score
        if ($request->input('question') == $game[$qno]['answer']) {
            $score++;
            $request->session()->put('score', $score);
        }


        // check to see if the game is over
        if($qno == count($game)) {
            $gametype = $request->session()->get('gametype');
            if($gametype == 'warp') {
                // get the end time
                $startTime = $request->session()->get('startTime');
                $endTime = time();
                //dump($startTime);
                //dump($endTime);
                $time = $endTime-$startTime;
            }
            else {
                $time = 0;
            }

            // game is complete
            // switch to gameover view
            return view('trivia.score')->with([
                'qno' => $qno,
                'score' => $score,
                'time' => $time,
                'logo' => $displayLogo,
            ]);
        }

        // increment the question number
        $qno++;
        // save the session data and go to the next question
        $request->session()->put('qno', $qno);
        //$answers = $game[$qno]['a'] + $game[$qno]['b'] $game[$qno]['c'] + $game[$qno]['d']
        $question = $game[$qno];

        return view('trivia.game')->with([
            'question' => $question,
            'qno' => $qno,
            'score' => $score,
            'logo' => $displayLogo,
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
