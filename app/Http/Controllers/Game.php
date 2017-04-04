<?php

namespace App\Http\Controllers;

class Game {

    /* Properties */

    private $game;
    private $category;
    private $logo;
    private $numQuestions;

    /*
     * Constructor
     */
    public function __construct($category, $level, $numQuestions = 10) {
        $this->category = $category;
        $this->numQuestions = $numQuestions;

        $elite = '';
        if ($level) {
            $elite = '_elite';
        }

        // for now just get the elite questions from a different file
        switch ($category) {
        case 'st_tos':
            $this->gameFile = '/tos'.$elite.'.json';
            $this->logo = 'st_tos.png';
            break;
        case 'st_tng':
            $this->gameFile = '/tng'.$elite.'.json';
            $this->logo = 'st_tng.jpg';
            break;
        case 'ds9':
            $this->gameFile = '/ds9'.$elite.'.json';
            $this->logo = 'ds9.jpg';
            break;
        case 'voyager':
            $this->gameFile = '/voyager'.$elite.'.json';
            $this->logo = 'voyager.jpg';
            break;
        case 'enterprise':
            $this->gameFile = '/enterprise'.$elite.'.json';
            $this->logo = 'enterprise.jpg';
            break;
        default:
            $this->gameFile = '/tos'.$elite.'.json';
            $this->logo = 'st_tos.png';
        }

        // check to see that the file exists


        // read the file and load the questions
        $questions = file_get_contents(database_path().$this->gameFile);

        # Decode the book JSON data into an array
        # Nothing fancy here; just a built in PHP method
        $this->game = json_decode($questions, true);

    }

    // gets a random question from the question bank
    public function getQuestion() {
        $num = rand(1, count($this->game));
        return $this->game[$num];
    }

    // returns the Star Trek logo image for the game selected
    public function getLogo() {
        return $this->logo;
    }

    // returns the number of questions to ask per game
    public function getNumQuestions() {
        return $this->numQuestions;
    }
}
