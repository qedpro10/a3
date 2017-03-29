{{-- /resources/views/trivial/game.blade.php --}}
@extends('layouts.master')

@section('title')
    Trivia Game
@endsection

@section('content')
    <h1>Question {{ $qno }}</h1>

    <form method='POST' action='/game'>
        {{ csrf_field() }}
        <h3>{{ $game[$qno]['question'] }}</h3>
        <ul class="gamestyle">
            <li>
                <label><input type='radio' name='question' value='a'> {{$game[$qno]['a']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='b'> {{$game[$qno]['b']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='c'> {{$game[$qno]['c']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='d'> {{$game[$qno]['d']}}</label>
            </li>
            <li>
                <label><input type='radio' name='question' value='e'> {{$game[$qno]['e']}}</label>
            </li>
        </ul>

        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-md " value='Submit'>
        </div>
    </form>




@endsection
