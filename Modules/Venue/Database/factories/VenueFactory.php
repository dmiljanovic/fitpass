<?php

namespace Modules\Venue\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Venue\Entities\Venue;

class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'capacity' => 100,
        ];
    }
}

