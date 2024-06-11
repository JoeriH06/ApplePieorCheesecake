<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Recipe::create($request->all());

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $recipe->update($request->all());

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }
}
