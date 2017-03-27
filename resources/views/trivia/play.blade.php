{{-- /resources/views/trivia/play.blade.php --}}
@extends ('layouts.master')

@section('title')
    Play
@endsection

@section('content')
    <h1>Welcome to Triviae Meretrix</h1>

    <form method='GET' action='/play'>
        <label>Choose your poison: </label>
        <select name='category'>
            <option value="pick" {{ ($category == 'pick') ? 'SELECTED' : '' }}>pick</option>
            <option value="history" {{ ($category == 'history') ? 'SELECTED' : '' }}>History</option>
            <option value="geography" {{ ($category == 'geography') ? 'SELECTED' : '' }}>Geography</option>
            <option value="startrek" {{ ($category == 'startrek') ? 'SELECTED' : '' }}>Star Trek</option>
        </select>
        <br>
        <fieldset class='radios'>
            <label>Game Type: </label>
            <label><input type='radio' name='gametype' value='clock' {{ ($gametype == 'clock') ? 'CHECKED' : '' }}> Clock</label>
            <label><input type='radio' name='gametype' value='opponent' {{ ($gametype == 'opponent') ? 'CHECKED' : '' }}> Opponent</label>
        </fieldset>

        <p>
            <label>Elite: </label>
            <input type='checkbox' name="elite" {{ ($elite) ? 'CHECKED' : '' }}>
        </p>

        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-sm " value='Play'>
        </div>
    </form>
@endsection
