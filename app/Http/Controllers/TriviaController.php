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

        // instantiate a new game
        $game = new Game($category, $elite);

        // get the logo of the game (based on category selected when game
        // was instantiated)
        $displayLogo = $game->getLogo();

        // initialize the game parameters score and question number (qno)
        $score = 0;
        $qno = 1;

        // get the start time
        $startTime = time();

        // get the first random question
        $question = $game->getQuestion();

        // save this data in the session
        $request->session()->put('game', $game);
        $request->session()->put('question', $question);
        $request->session()->put('qno', $qno);
        $request->session()->put('score', $score);
        $request->session()->put('logo', $displayLogo);
        $request->session()->put('gametype', $gametype);
        $request->session()->put('elite', $elite);
        $request->session()->put('category', $category);
        $request->session()->put('time', $startTime);
        $request->session()->save();

        // redirect to the game page to show the first question
        // using redirect so that reload will work properly
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

        // get the game data from the session
        $question= $request->session()->get('question');
        $qno = $request->session()->get('qno');
        $score = $request->session()->get('score');
        $displayLogo = $request->session()->get('logo');

        // set the view to the game page
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
        $game = $request->session()->get('game');

        // update the score, compare the answer selected with the correct
        // answer stored in the question data
        if ($request->input('question') == $question['answer']) {
            // update the score and store it to the session data
            $score++;
            $request->session()->put('score', $score);
        }


        // check to see if the game is over
        if($qno == $game->getNumQuestions()) {
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

            // save the time value in the session data for display
            $request->session()->put('time', $time);
            $request->session()->save();

            // game is over - redirect tot he score page to show the results
            return redirect('/score');
            //->with([
            //    'qno' => $qno,
            //    'score' => $score,
            //    'time' => $time,
            //    'logo' => $displayLogo,
            //]);
        }

        // increment the question number
        $qno++;

        // get the next random question and store it
        $question = $game->getQuestion();

        // save the session data and go to the next question
        $request->session()->put('question', $question);
        $request->session()->put('qno', $qno);
        $request->session()->save();

        // redirect to the game page with the new question
        return redirect('/game')->with([
            'question' => $question,
            'qno' => $qno,
            'score' => $score,
            'logo' => $displayLogo,
        ]);
    }

    /*
     *
     * GET
     * /score
     * This function shows the score page when the game is complete
     */
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
    * Return to the /play page on quit or /game page on Play Again
    * This function processes POST action when the player selects either
    * Play Again or Quit
    * If play again, the score and question number are reset, and the game is
    * continued with a new set of questions.  Note the same category and game
    * questions are used, it is just a continuation of the same Game.
    * If quit is selected, the user is returned to the /play page to reselect
    * a new game with new options.
    */
    public function processScore(Request $request) {
        // the end of the game gives the user 2 choices
        // play another round of the same game
        // or quit and go back to the main menu
        switch($request->input('play')) {

            case 'Play Again?':
                $game = $request->session()->get('game', 'default');
                $displayLogo = $request->session()->get('logo', 'default');

                // reset the game
                $qno = 1;
                $score = 0;


                // get the next question
                $question = $game->getQuestion();

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
