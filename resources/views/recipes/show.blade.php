@extends('layout.main')

@section('title', $recipe->name)

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-feldgrau">{{ $recipe->name }}</h1>
    <p class="text-battleship-gray">{{ $recipe->description }}</p>
    <a href="{{ route('recipes.index') }}" class="text-ash-gray hover:underline mt-4 block">Back to Recipes</a>
@endsection
