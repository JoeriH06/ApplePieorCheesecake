@extends('layout.main')

@section('title', $recipe->name)

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $recipe->name }}</h1>
    <p>{{ $recipe->description }}</p>
    <a href="{{ route('recipes.index') }}" class="text-indigo-500 hover:underline mt-4 block">Back to Recipes</a>
@endsection
