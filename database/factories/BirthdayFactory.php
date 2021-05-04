<?php

namespace Database\Factories;

use App\Models\Birthday;
use Illuminate\Database\Eloquent\Factories\Factory;

class BirthdayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Birthday::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(100),
            'date' => $this->faker->dateTimeBetween('now', '+2 days'),
            'time' => $this->faker->time('H:i:s', 'now'),
            'all_day' => false,
            'every_year' => false,
            'user_id' => rand(1,5),
        ];
    }
}
