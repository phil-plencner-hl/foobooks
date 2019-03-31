@extends('layouts.master')

@section('content')
    <h1>Contact</h1>
    <p>
        For information or help, please email {{ config('mail.supportEmail') }}.
    </p>
@endsection