@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="mx-auto max-w-5xl px-4 py-12 text-center">
        <h1 class="text-4xl font-bold text-primary">Welcome to LocationBD</h1>
        <p class="mt-4 text-lg text-secondary">Your home page is working and rendered from HomeController@index.</p>
        <p class="mt-2 text-sm text-muted">Current time: {{ now()->toDayDateTimeString() }}</p>
    </div>
@endsection
