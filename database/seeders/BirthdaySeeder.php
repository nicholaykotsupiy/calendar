<?php

namespace Database\Seeders;

use App\Models\Birthday;
use Illuminate\Database\Seeder;

class BirthdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Birthday::factory(1)->create();
        \App\Models\Birthday::insert([
            [
                'name' => 'др Оли',
                'description' => 'тетя Оля, 1960г',
                'date' => '2021-05-12',
                'time' => '08:00',
                'all_day' => 0,
                'every_year' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'др мамы',
                'description' => 'мама, 1965г',
                'date' => '2021-04-21',
                'time' => '11:00',
                'all_day' => 0,
                'every_year' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'др Серегея',
                'description' => 'сын, 2010г',
                'date' => '2021-06-03',
                'time' => '08:00',
                'all_day' => 0,
                'every_year' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'мой др',
                'description' => 'а вдруг забуду!',
                'date' => '2021-05-27',
                'time' => '08:00',
                'all_day' => 1,
                'every_year' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'др папы',
                'description' => 'папа, 1956г',
                'date' => '2021-03-31',
                'time' => '07:00',
                'all_day' => 0,
                'every_year' => 1,
                'user_id' => 1,
            ],
        ]);
    }
}
