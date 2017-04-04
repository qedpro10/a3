{{-- /resources/views/trivial/game.blade.php --}}
@extends('layouts.master')

@section('title')
    Star Trekivia
@endsection

@section('picture')
    images/{{$logo}}
@endsection

@section('quiz')
    <h1>Question {{ $qno }}</h1>

    <form method='POST' action='/game/checkAnswer'>
        {{ csrf_field() }}
        <h3>{{ $question['question'] }}</h3>
        <ul>
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

            <input type='submit' class="btn btn-info btn-md " value='Submit'>

    </form>

@endsection
