@extends('layout.main')

@section('title', 'Recipes')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-feldgrau">Recipes</h1>

    <section class="mb-6">
        <a href="{{ route('recipes.create') }}" class="bg-celadon text-feldgrau py-2 px-4 rounded">Create New Recipe</a>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($recipes as $recipe)
            <article class="p-4 bg-mint-cream shadow-md rounded">
                <h2 class="text-xl font-semibold mb-2 text-feldgrau">{{ $recipe->name }}</h2>
                <p class="text-battleship-gray">{{ $recipe->description }}</p>
                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-ash-gray hover:underline">Read More</a>
                <section class="mt-2 flex space-x-2">
                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="bg-ash-gray text-feldgrau py-1 px-2 rounded">Edit</a>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-feldgrau text-white py-1 px-2 rounded">Delete</button>
                    </form>
                </section>
            </article>
        @endforeach
    </section>
@endsection
