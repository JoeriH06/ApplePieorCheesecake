@extends('layout.main')

@section('title', 'Edit Recipe')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Recipe</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" id="edit-recipe-form">
        @csrf
        @method('PUT')
        <section class="mb-4">
            <label for="name" class="block text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded" value="{{ $recipe->name }}">
        </section>

        <section class="mb-4">
            <label for="description" class="block text-sm font-bold mb-2">Description</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded">{{ $recipe->description }}</textarea>
        </section>

        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Update</button>
    </form>
@endsection
