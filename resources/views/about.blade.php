@extends('layouts.master')

@section('content')
    <h1>About</h1>
    <p>
        @include('includes.description')
    </p>

    <p>
        The source code for this project can be viewed here:
        <a href='{{ config('app.githubUrl') }}'>{{ config('app.githubUrl') }}</a></p>
    </p>
@endsection