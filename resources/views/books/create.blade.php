@extends('layouts.master')

@section('title')
    Add a book
@endsection

@section('content')
    <h1>Add a book</h1>

    <form method='POST' action='/books'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title') }}'>
        @include('includes.error-field', ['fieldName' => 'title'])

        <label for='author'>* Author</label>
        <input type='text' name='author' id='author' value='{{ old('author') }}'>
        @include('includes.error-field', ['fieldName' => 'author'])

        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' name='published_year' id='published_year' value='{{ old('published_year') }}'>
        @include('includes.error-field', ['fieldName' => 'published_year'])

        <label for='cover_url'>* Cover URL</label>
        <input type='text' name='cover_url' id='cover_url'  value='{{ old('cover_url', 'http://') }}'>
        @include('includes.error-field', ['fieldName' => 'cover_url'])

        <label for='purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url'  value='{{ old('purchase_url', 'http://') }}'>
        @include('includes.error-field', ['fieldName' => 'purchase_url'])

        <input type='submit' value='Add book'>
    </form>

    @if(count($errors) > 0)
        <div class='alert alert-danger'>Please fix the errors above.</div>
    @endif
@endsection