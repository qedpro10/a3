<?php


class Game {

    /* Properties */

    private $game;
    private $category;

    /*
     * Constructor
     */
    public function __construct($category, $numQuestions = 10) {
        $this->category = $category;
        switch ($category) {
        case 'history':
            $gameFile = '/history.json';
            break;
        case 'geography':
            $gameFile = '/geography.json';
            break;
        case 'startrek':
            $gameFile = '/startrek.json';
            break;
        case 'random':
        default:
            $gameFile = '/questions.json';
        }

        // check to see that the file exists

        // read the file and load the questions
        $questions = file_get_contents(database_path().'/questions.json');
        # Decode the book JSON data into an array
        # Nothing fancy here; just a built in PHP method
        $game = json_decode($questions, true);

    }

    public function getGame() {
        return $this->$game;
    }
}
