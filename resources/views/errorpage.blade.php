@extends('layout.main')

@section('title', 'Error')

@section('content')
    <main class="text-center mx-auto mt-8 mb-4 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-red-600 mb-4">Oops! Something went wrong.</h1>
        <p class="text-base sm:text-lg text-gray-700 mb-4">We're sorry, but an error occurred while processing your request.</p>
        <p class="text-base sm:text-lg text-gray-700 mb-8">Please try again later or contact support if the problem persists.</p>
        <a href="/" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Go back to home</a>
    </main>
@endsection
