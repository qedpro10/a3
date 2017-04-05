{{-- /resources/views/trivia/play.blade.php --}}
@extends ('layouts.master')

@section('title')
    Star Trekivia
@endsection

@section('picture')
    images/st_tos.png
@endsection

@section('content')
    <h4>Please select your game</h4>
    <br>
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
        @if($errors->has('category'))
            <label id="error">*Required</label>
        @else
            <label>*Required</label>
        @endif
        <br><br>
        <fieldset class='radios'>
            <label>Game Type: </label>
            <label><input type='radio' name='gametype' value='impulse' checked="checked" @if(old('gametype') == 'impulse') CHECKED @endif>Impulse</label>
            <label><input type='radio' name='gametype' value='warp' @if(old('gametype') == 'warp') CHECKED @endif>Warp Speed</label>
        </fieldset>
        <br>
        <p>
            <label>I'm a Trekkie: </label>
            <input type='checkbox' name='elite' @if(old('elite')) CHECKED @endif>
        </p>

        <div class="btn-calc">
            <input type='submit' class="btn btn-info btn-md " value='Engage'>
        </div>
    </form>



@endsection
