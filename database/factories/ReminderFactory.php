<?php

namespace Database\Factories;

use App\Models\Reminder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reminder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'date' => $this->faker->dateTimeBetween('now', '+7 days'),
            'time' => $this->faker->time('H:i:s'),
            'repeat' => 'не повторять',
            'user_id' => rand(1,5),
        ];
    }
}
