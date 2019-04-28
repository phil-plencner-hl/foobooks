@extends('layouts.master')

@section('title')
    Your Books
@endsection

@section('head')
    <link href='css/books/index.css' rel='stylesheet'>
    <link href='css/books/_book.css' rel='stylesheet'>
@endsection

@section('content')

    <section id='newBooks'>
        <h2>Recently Added Books</h2>
        @foreach ($newBooks as $book)
            @include('books._book')
        @endforeach
    </section>

    <section id='yourBooks'>
        <h1>Your Books</h1>
        @foreach ($books as $book)
            @include('books._book')
        @endforeach
    </section>
@endsection