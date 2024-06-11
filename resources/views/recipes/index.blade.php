@extends('layout.main')

@section('title', 'Recipes')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Recipes</h1>

    <section class="mb-6">
        <a href="{{ route('recipes.create') }}" class="bg-green-500 text-white py-2 px-4 rounded">Create New Recipe</a>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($recipes as $recipe)
            <article class="p-4 bg-white shadow-md rounded">
                <h2 class="text-xl font-semibold mb-2">{{ $recipe->name }}</h2>
                <p>{{ $recipe->description }}</p>
                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-indigo-500 hover:underline">Read More</a>
                <section class="mt-2 flex space-x-2">
                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="bg-yellow-500 text-white py-1 px-2 rounded">Edit</a>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Delete</button>
                    </form>
                </section>
            </article>
        @endforeach
    </section>
@endsection
