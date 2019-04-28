@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <h1>Search</h1>

    <form method='GET' action='/books/search-process'>

        <fieldset>
            <label for='searchTerm'>Search by title:</label>
            <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm }}'>
            @include('includes.error-field', ['fieldName' => 'searchTerm'])

            <input type='checkbox' name='caseSensitive' {{ ($caseSensitive ? 'checked' : '') }}>
            <label>case sensitive</label>
        </fieldset>

        <input type='submit' value='Search' class='btn btn-primary'>

    </form>

    @if($searchTerm)
        <h2>Results for query: <em>{{ $searchTerm }}</em></h2>

        @if(count($books) == 0)
            No matches found.
        @else
            @foreach ($books as $book)
                @include('books._book')
            @endforeach
        @endif
    @endif

@endsection