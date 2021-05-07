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
            'name' => $this->faker->name,
            'location' => $this->faker->address,
            'description' => $this->faker->text(100),
            'date_start' => $this->faker->dateTimeBetween('now', '+1 days'),
            'date_end' => $this->faker->dateTimeBetween('now', '+2 days'),
            'time_start' => $this->faker->time('H:i:s', 'now'),
            'time_end' => $this->faker->time('H:i:s', '+2 hours'),
            'user_id' => rand(1,5)
        ];
    }
}
