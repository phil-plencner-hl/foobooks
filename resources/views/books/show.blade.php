@extends('layouts.master')

@section('title')
    {{ $book->title }}
@endsection

@section('head')
    {{-- Page specific CSS includes should be defined here; this .css file does not exist yet, but we can create it --}}
    <link href='/css/books/show.css' rel='stylesheet'>
@endsection

@section('content')
    <h1>{{ $book->title }}</h1>

    <div class='book cf'>
        <img src='{{ $book->cover_url }}' class='cover' alt='Cover image for {{ $book->title }}'>
        <p>By {{ $book->author->first_name . ' '. $book->author->last_name }} ({{ $book->published_year }})</p>
        <p>Added {{ $book->created_at->format('m/d/y') }}</p>

        <ul class='bookActions'>
            <li><a href='{{ $book->purchase_url }}'><i class="fas fa-shopping-cart"></i> Purchase</a>
            <li><a href='/books/{{ $book->id }}/edit'><i class="fas fa-edit"></i> Edit</a>
        </ul>
        <form method='POST' action='/books/{{ $book->id }}'>
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <input type='submit' class='btn btn-primary' value='Delete book'>
        </form>
    </div>
@endsection



