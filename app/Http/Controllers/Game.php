<?php

namespace App\Http\Controllers;

class Game {

    /* Properties */

    private $game;
    private $category;

    /*
     * Constructor
     */
    public function __construct($category, $level, $numQuestions = 10) {
        $this->category = $category;

        $elite = '';
        if ($level) {
            $elite = '_elite';
        }

        // for now just get the elite questions from a different file
        switch ($category) {
        case 'st_tos':
            $gameFile = '/tos'.$elite.'.json';
            break;
        case 'st_tng':
            $gameFile = '/tng'.$elite.'.json';
            break;
        case 'ds9':
            $gameFile = '/ds9'.$elite.'.json';
            break;
        case 'voyager':
            $gameFile = '/voyager'.$elite.'.json';
            break;
        case 'enterprise':
            $gameFile = '/enterprise'.$elite.'.json';
            break;
        default:
            $gameFile = '/tos'.$elite.'.json';
        }

        // check to see that the file exists


        // read the file and load the questions
        $questions = file_get_contents(database_path().$gameFile);
        //dump($questions);

        # Decode the book JSON data into an array
        # Nothing fancy here; just a built in PHP method
        $this->game = json_decode($questions, true);
        //dump($this->game);

    }

    public function getGame() {
        return $this->game;
    }
}
