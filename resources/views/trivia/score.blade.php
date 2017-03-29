{{-- /resources/views/trivial/score.blade.php --}}
@extends('layouts.master')

@section('title')
    Trivia Game Score
@endsection

@section('content')

    <h1>Score</h1>
    <p>{{$score}}/{{$qno}}</p>

    <form method='GET' action='/play'>
        {{ csrf_field() }}


        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-md " value='Play Again?'>
        </div>
    </form>

@endsection
