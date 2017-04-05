{{-- /resources/views/trivial/score.blade.php --}}
@extends('layouts.master')

@section('title')
    Trivia Game Score
@endsection

@section('picture')
    images/{{$logo}}
@endsection

@section('content')

    <h3>Score:  {{$score}}/{{$qno}}</h3>
    @if($time != 0)
        <h3>Time: {{$time}} seconds</h3>
    @endif

    <form method='POST' action='/score'>
        {{ csrf_field() }}
        <div class="btn-calc">
            <input type='submit' name="play" class="btn btn-info btn-md " value='Play Again'>
            <input type='submit' name="play" class="btn btn-info btn-md " value='Quit'>
        </div>
    </form>

@endsection
