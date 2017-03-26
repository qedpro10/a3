<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PigController extends Controller
{
    /**
    * GET
    * /pig
    */
    public function translate($translation = null) {
        return view('pig.translate')->with([
            'translation' => $translation,
        ]);
    }
}
