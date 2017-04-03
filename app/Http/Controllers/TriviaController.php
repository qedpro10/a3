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


        $triviaGame = new Game($category, $elite);
        $game = $triviaGame->getGame();

        $displayLogo = $triviaGame->getLogo();
        // initialize the game parameters score and question number (qno)
        $score = 0;
        $qno = 1;

        // save this data in the session
        $request->session()->put('stgame', $triviaGame);
        $request->session()->put('qno', $qno);
        $request->session()->put('score', $score);
        $request->session()->put('logo', $displayLogo);
        $request->session()->put('gametype', $gametype);
        $request->session()->put('elite', $elite);
        $request->session()->put('category', $category);

        // get the question
        $question = $triviaGame->getQuestion();
        $request->session()->put('question', $question);

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
        $stgame = $request->session()->get('stgame', 'default');
        $question = $request->session()->get('question', 'default');
        $qno = $request->session()->get('qno', 'default');
        $score = $request->session()->get('score', 'default');
        $displayLogo = $request->session()->get('logo', 'default');


        $answer = $question['answer'];

        // update the score
        if ($request->input('question') == $question['answer']) {
            $score++;
            $request->session()->put('score', $score);
        }


        // check to see if the game is over
        if($qno == 2) {
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

        // get the next question and store it
        $question = $stgame->getQuestion();
        $request->session()->put('question', $question);

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
        // the end of the game gives the user 2 choices
        // play another round of the same game
        // or quit and go back to the main menu
        switch($request->input('play')) {

            case 'Play Again?':
                $stgame = $request->session()->get('stgame', 'default');
                $displayLogo = $request->session()->get('logo', 'default');

                // reset the game
                $qno = 1;
                $score = 0;
                $request->session()->put('qno', $qno);
                $request->session()->put('score', $score);

                // get the next question
                $question = $stgame->getQuestion();
                $request->session()->put('question', $question);

                // start the game over
                return view('trivia.game')->with([
                    'question' => $question,
                    'qno' => $qno,
                    'score' => $score,
                    'logo' => $displayLogo,
                ]);
            break;

            case 'Quit':
            default:
                $category = $request->session()->get('category', 'default');
                $elite = $request->session()->get('elite', 'default');
                $gametype = $request->session()->get('gametype', 'default');
                $request->session()->flush();
                return view('trivia.play')->with([
                    'category' => $category,
                    'elite' => $elite,
                    'gametype' => $gametype,
                ]);
            break;
        }
    }
}
