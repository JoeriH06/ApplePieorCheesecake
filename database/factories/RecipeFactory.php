<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition()
    {
    //     $recipeNames = [
    //         'Classic Apple Pie',
    //         'Cinnamon Apple Cheesecake',
    //         'Grandma’s Apple Pie',
    //         'New York Cheesecake',
    //         'Caramel Apple Cheesecake',
    //         'Apple Crumble Pie',
    //         'Vanilla Bean Cheesecake',
    //         'Blueberry Apple Pie',
    //         'Pumpkin Spice Cheesecake',
    //         'Maple Pecan Apple Pie'
    //     ];

    //     $recipeDescriptions = [
    //         'Preheat oven to 350°F (175°C). In a large bowl, mix sliced apples, sugar, cinnamon, and nutmeg. Place the mixture into a prepared pie crust, cover with another crust, seal the edges, and make slits in the top. Bake for 45-50 minutes or until the crust is golden brown.',
    //         'Prepare the crust by mixing graham cracker crumbs with melted butter. Press into the bottom of a springform pan. For the filling, beat cream cheese until smooth, then add sugar, eggs, and vanilla extract. Fold in apple slices mixed with cinnamon. Pour into the crust and bake at 325°F (160°C) for 55-60 minutes.',
    //         'Combine flour, sugar, and butter to create a crumbly topping. Arrange sliced apples in a pie dish, sprinkle with lemon juice, and cover with the crumb mixture. Bake at 375°F (190°C) for 40-45 minutes until the topping is golden and the apples are tender.',
    //         'Preheat oven to 325°F (160°C). Mix cream cheese, sugar, and vanilla until smooth. Add eggs one at a time, blending well after each addition. Pour over a graham cracker crust and bake for 55 minutes. Cool and refrigerate for at least 4 hours before serving.',
    //         'Make the crust by combining graham cracker crumbs and melted butter. In a bowl, mix cream cheese, sugar, and vanilla. Add eggs, one at a time, mixing well after each addition. Fold in caramel sauce and diced apples. Pour into the crust and bake at 325°F (160°C) for 60 minutes. Drizzle with additional caramel before serving.',
    //         'Mix flour, sugar, and butter to form a crumbly topping. Layer apple slices in a pie dish, sprinkle with lemon juice, and cover with the crumb topping. Bake at 375°F (190°C) for 45 minutes or until the topping is golden and crisp.',
    //         'Preheat oven to 350°F (175°C). Combine cream cheese, sugar, and vanilla bean seeds. Add eggs, one at a time, mixing well. Pour over a graham cracker crust and bake for 50-55 minutes. Cool and refrigerate before serving.',
    //         'Arrange blueberries and apple slices in a pie crust. Mix sugar, flour, and lemon zest and sprinkle over the fruit. Cover with a top crust, seal edges, and cut slits. Bake at 375°F (190°C) for 50-55 minutes until the crust is golden and the filling is bubbly.',
    //         'Mix crushed graham crackers with melted butter and press into a springform pan. Beat cream cheese, sugar, and pumpkin puree until smooth. Add eggs, spices, and vanilla, and blend well. Pour over the crust and bake at 325°F (160°C) for 60 minutes. Cool and refrigerate before serving.',
    //         'Prepare the crust by combining graham cracker crumbs, melted butter, and chopped pecans. Beat cream cheese, sugar, and maple syrup until smooth. Add eggs one at a time, blending well. Pour over the crust and bake at 325°F (160°C) for 60 minutes. Top with pecan halves and drizzle with additional maple syrup before serving.'
    //     ];

    //     return [
    //         'name' => $this->faker->randomElement($recipeNames),
    //         'description' => $this->faker->randomElement($recipeDescriptions),
    //     ];
     }
}
