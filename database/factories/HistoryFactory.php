<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = History::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => ProductFactory::class,
            'price' => $this->faker->numberBetween(1.5, 9.85),
            'previous_balance' => $this->faker->numberBetween(1.5, 9.85),
            'movement' => $this->faker->numberBetween(1.5, 9.85),
            'final_balance' => $this->faker->numberBetween(1.5, 9.85),
        ];
    }
}
