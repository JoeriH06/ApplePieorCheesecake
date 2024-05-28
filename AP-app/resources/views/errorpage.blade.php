@extends('layout.main')

@section('title', 'Error')

@section('content')
    <main class="max-w-lg mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-red-600 mb-4">Oops! Something went wrong.</h1>
        <p class="text-lg text-gray-700 mb-8">We're sorry, but an error occurred while processing your request.</p>
        <p class="text-lg text-gray-700 mb-8">Please try again later or contact support if the problem persists.</p>
        <a href="/" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Go back to home</a>
    </main>
@endsection
