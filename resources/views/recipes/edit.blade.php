@extends('layout.main')

@section('title', 'Edit Recipe')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-feldgrau">Edit Recipe</h1>

    @if ($errors->any())
        <div class="bg-feldgrau text-white p-4 mb-4 rounded">
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
            <label for="name" class="block text-sm font-bold mb-2 text-feldgrau">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-feldgrau rounded" value="{{ $recipe->name }}">
        </section>

        <section class="mb-4">
            <label for="description" class="block text-sm font-bold mb-2 text-feldgrau">Description</label>
            <textarea name="description" id="description" class="w-full p-2 border border-feldgrau rounded">{{ $recipe->description }}</textarea>
        </section>

        <button type="submit" class="bg-celadon text-feldgrau py-2 px-4 rounded">Update</button>
    </form>
@endsection
