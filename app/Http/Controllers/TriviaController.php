<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TriviaController extends Controller
{
    /**
    * GET
    * /play
    */

    public function play(Request $request) {


        # Store the game category in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* category is not in the request.
        $category = $request->input('category', null);
        $elite = $request->has('elite');
        $gametype = $request->input('gametype', null);
        # Only play game if a category has been selected
        if($category) {

        }

        # Return the view, with the category, gametype and elite (if any)
        return view('trivia.play')->with([
            'category' => $category,
            'elite' => $request->has('elite'),
            'gametype' => $gametype,
        ]);
    }
}
