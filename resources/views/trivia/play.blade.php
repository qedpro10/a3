{{-- /resources/views/trivia/play.blade.php --}}
@extends ('layouts.master')

@section('title')
    Play
@endsection

@section('content')

    <form method='POST' action='/play'>
        {{ csrf_field() }}
        <label>Choose your poison:  </label>
        <select name='category'>
            <option value='' {{ ($category == '') ? 'SELECTED' : '' }}>Select Category</option>
            <option value="history" {{ ($category == 'history') ? 'SELECTED' : '' }}>History</option>
            <option value="geography" {{ ($category == 'geography') ? 'SELECTED' : '' }}>Geography</option>
            <option value="startrek" {{ ($category == 'startrek') ? 'SELECTED' : '' }}>Star Trek</option>
        </select>
        <label>*Required</label>
        <br><br>
        <fieldset class='radios'>
            <label>Game Type: </label>
            <label><input type='radio' name='gametype' value='leisure' {{ ($gametype == 'leisure') ? 'CHECKED' : 'CHECKED' }}> Leisure</label>
            <label><input type='radio' name='gametype' value='speed' {{ ($gametype == 'speed') ? 'CHECKED' : '' }}> Speed</label>
        </fieldset>
        <br>
        <p>
            <label>Elite: </label>
            <input type='checkbox' name="elite" {{ ($elite) ? 'CHECKED' : '' }}>
            <label>Only if you dare!</label>
        </p>

        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-md " value='Play'>
        </div>
    </form>

    @if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
@endsection
