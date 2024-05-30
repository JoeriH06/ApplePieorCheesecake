<?php

// database/factories/EnappsysDataFactory.php

namespace Database\Factories;

use App\Models\EnappsysData;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnappsysDataFactory extends Factory
{
    protected $model = EnappsysData::class;

    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'actual_da_price' => $this->faker->randomFloat(2, 1, 100) . ' EUR/MWh',
        ];
    }
}

