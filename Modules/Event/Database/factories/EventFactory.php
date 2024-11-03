<?php

namespace Modules\Event\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Event\Entities\Event;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'available_tickets' => 100,
            'ticket_sales_end_date' => Carbon::now()->addDay(),
        ];
    }
}

