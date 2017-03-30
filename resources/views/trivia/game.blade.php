{{-- /resources/views/trivial/game.blade.php --}}
@extends('layouts.master')

@section('title')
    Trivia Game
@endsection

@section('content')
    <h1>Question {{ $qno }}</h1>

    <form method='POST' action='/game'>
        {{ csrf_field() }}
        <h3>{{ $question['question'] }}</h3>
        <ul class="gamestyle">
            <li>
                <label><input type='radio' name='question' value='a'> {{$question['a']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='b'> {{$question['b']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='c'> {{$question['c']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='d'> {{$question['d']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='e'> {{$question['e']}}</label>
            </li>
        </ul>

        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-md " value='Submit'>
        </div>
    </form>

@endsection
