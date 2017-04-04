<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Game;


class TriviaController extends Controller
{

    /**
	* GET
    * /play - start the game
	*/
    public function index(Request $request) {

        return view('trivia.play')->with([
            'category' => $request->input('category'),
            'elite' => $request->has('elite'),
            'gametype' => $request->input('gametype'),
        ]);
    }
    /**
    * POST
    * /play - sets up game, then redirects to /game
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
        //$game = $triviaGame->getGame();

        $displayLogo = $triviaGame->getLogo();
        // initialize the game parameters score and question number (qno)
        $score = 0;
        $qno = 1;

        // get the start time
        $startTime = time();

        // save this data in the session
        $question = $triviaGame->getQuestion();

        $request->session()->put('stgame', $triviaGame);
        $request->session()->put('question', $question);
        $request->session()->put('qno', $qno);
        $request->session()->put('score', $score);
        $request->session()->put('logo', $displayLogo);
        $request->session()->put('gametype', $gametype);
        $request->session()->put('elite', $elite);
        $request->session()->put('category', $category);
        $request->session()->put('time', $startTime);
        $request->session()->save();

        return redirect('/game')->with([
            'question' => $question,
            'qno' => $qno,
            'score' => $score,
            'logo' => $displayLogo,
        ]);
    }

    /**
    * GET
    * /game
    * Show the question; to be repeated for the number of questions
    * in the quiz
    */
    public function showQuestion(Request $request) {
        $question= $request->session()->get('question');
        $qno = $request->session()->get('qno');
        $score = $request->session()->get('score');
        $displayLogo = $request->session()->get('logo');

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
    * checks the answer and redirects back to showQuestion
    */
    public function checkAnswer(Request $request) {

        // get the game session data
        $question = $request->session()->get('question');
        $qno = $request->session()->get('qno');
        $score = $request->session()->get('score');
        $displayLogo = $request->session()->get('logo');

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
                $startTime = $request->session()->get('time');
                $endTime = time();
                $time = $endTime-$startTime;
            }
            else {
                $time = 0;
            }

            // game is complete
            // switch to gameover view
            $request->session()->put('time', $time);
            $request->session()->save();
            //return view('trivia.score')->with([
            return redirect('/score')->with([
                'qno' => $qno,
                'score' => $score,
                'time' => $time,
                'logo' => $displayLogo,
            ]);
        }

        // increment the question number
        $qno++;

        // get the next random question and store it
        $stgame = $request->session()->get('stgame', 'default');
        $question = $stgame->getQuestion();

        // save the session data and go to the next question
        $request->session()->put('question', $question);
        $request->session()->put('qno', $qno);
        $request->session()->save();

        return redirect('/game')->with([
            'question' => $question,
            'qno' => $qno,
            'score' => $score,
            'logo' => $displayLogo,
        ]);
    }

    public function showScore(Request $request) {

        $score = $request->session()->get('score');
        $time = $request->session()->get('time');
        $displayLogo = $request->session()->get('logo');
        $qno = $request->session()->get('qno');

        return view('trivia.score')->with([
            'time' => $time,
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


                // get the next question
                $question = $stgame->getQuestion();

                $request->session()->put('question', $question);
                $request->session()->put('qno', $qno);
                $request->session()->put('score', $score);
                $request->session()->save();

                // start the game over
                return redirect('/game')->with([
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
                $request->session()->save();
                return redirect('/play')->with([
                    'category' => $category,
                    'elite' => $elite,
                    'gametype' => $gametype,
                ]);
            break;
        }
    }
}
