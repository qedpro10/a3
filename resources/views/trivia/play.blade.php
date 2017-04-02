{{-- /resources/views/trivia/play.blade.php --}}
@extends ('layouts.master')

@section('title')
    Play
@endsection

@section('picture')
    images/st_tos.png
@endsection

@section('content')

    <form method='POST' action='/play'>
        {{ csrf_field() }}
        <label>Select the series:  </label>
        <select name='category'>
            <option value='' {{ ($category == '') ? 'SELECTED' : '' }}>Select Category</option>
            <option value="st_tos" {{ ($category == 'st_tos') ? 'SELECTED' : '' }}>Star Trek</option>
            <option value="st_tng" {{ ($category == 'st_tng') ? 'SELECTED' : '' }}>Next Generation</option>
            <option value="ds9" {{ ($category == 'ds9') ? 'SELECTED' : '' }}>Deep Space 9</option>
            <option value="voyager" {{ ($category == 'voyager') ? 'SELECTED' : '' }}>Voyager</option>
            <option value="enterprise" {{ ($category == 'enterprise') ? 'SELECTED' : '' }}>Enterprise</option>
        </select>
        <label>*Required</label>
        <br><br>
        <fieldset class='radios'>
            <label>Game Type: </label>
            <label><input type='radio' name='gametype' value='leisure' {{ ($gametype == 'leisure') ? 'CHECKED' : 'CHECKED' }}> Impulse</label>
            <label><input type='radio' name='gametype' value='speed' {{ ($gametype == 'speed') ? 'CHECKED' : '' }}> Warp Speed</label>
        </fieldset>
        <br>
        <p>
            <label>Trekkie: </label>
            <input type='checkbox' name="elite" {{ ($elite) ? 'CHECKED' : '' }}>
            <label>()</label>
        </p>

        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-md " value='Engage'>
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
