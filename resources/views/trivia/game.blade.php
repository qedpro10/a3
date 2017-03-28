{{-- /resources/views/trivial/game.blade.php --}}
@extends('layouts.master')

@section('title')
    Trivia Game
@endsection

@section('content')
    <h1>Question {{ $qno }}</h1>

    <form method='POST' action='/game'>
        {{ csrf_field() }}
        <h2>{{ $game[$qno]['question'] }}</h2>
        <ul>
            <li>
                <label><input type='radio' name='question' value='ans_a'> {{$game[$qno]['a']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='ans_b'> {{$game[$qno]['b']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='ans_c'> {{$game[$qno]['c']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='ans_d'> {{$game[$qno]['d']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='ans_e'> {{$game[$qno]['e']}}</label>
            </li>
        </ul>

        <input type='submit' value='Submit'>
    </form>




@endsection
