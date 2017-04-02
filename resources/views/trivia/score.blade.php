{{-- /resources/views/trivial/score.blade.php --}}
@extends('layouts.master')

@section('title')
    Trivia Game Score
@endsection

@section('picture')
    images/{{$logo}}
@endsection

@section('content')

    <h1>Score:  {{$score}}/{{$qno}}</h1>
    @if($time != 0)
        <h1>Time: {{$time}} seconds</h1>
    @endif

    <form method='GET' action='/play'>

        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-md " value='Play Again?'>
        </div>
    </form>

@endsection
