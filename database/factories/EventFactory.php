<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'eventName' => $this->faker->sentence(3),
            'startDate' => $this->faker->dateTimeBetween('now','+2 years'),
            'endDate' => $this->faker->dateTimeBetween('now','+2 years'),
            'time' => $this->faker->date('H:i')
        ];
    }
}
