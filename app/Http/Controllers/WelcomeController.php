<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /* Get /
    */
    public function __invoke() {
        return view('welcome');
    }
}
