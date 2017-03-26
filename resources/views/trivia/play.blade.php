@extends ('layouts.master')

@section('title')
    translate page {{ $translation }}
@endsection

@section('content')
    <h1>show translate {{ $translation }}</h1>
@endsection
