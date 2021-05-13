<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Event::factory(5)->create();
        \App\Models\Event::insert([
            [
                'name' => 'медитация в Шавасане',
                'location' => 'пол комнаты',
                'description' => 'приглашаются все желающие, но просьба не мешать',
                'date_start' => '2021-05-03',
                'date_end' => '2021-05-03',
                'time_start' => '17:00',
                'time_end' => '18:00',
                'user_id' => 1,
            ],
            [
                'name' => 'ребенок снова идет в школу!',
                'location' => 'подальше от дома',
                'description' => 'дистанционное обучение в школах - зло!',
                'date_start' => '2021-05-11',
                'date_end' => '2021-05-11',
                'time_start' => '07:00',
                'time_end' => '08:00',
                'user_id' => 1,
            ],
            [
                'name' => 'отмечаем защиту проекта',
                'location' => 'где придумаем',
                'description' => 'неужели мы доживем до этого момента?',
                'date_start' => '2021-05-31',
                'date_end' => '2021-05-31',
                'time_start' => '18:00',
                'time_end' => '20:00',
                'user_id' => 1,
            ],
            [
                'name' => 'полет на Марс',
                'location' => 'космический корабль',
                'description' => 'таких не берут в космонавты',
                'date_start' => '2021-06-05',
                'date_end' => '2021-06-10',
                'time_start' => '08:00',
                'time_end' => '20:00',
                'user_id' => 1,
            ],
            [
                'name' => 'идем на день рождения Пятачка',
                'location' => 'лес',
                'description' => 'Винни всех пригласил',
                'date_start' => '2021-05-15',
                'date_end' => '2021-05-15',
                'time_start' => '12:00',
                'time_end' => '15:00',
                'user_id' => 1,
            ],
            [
                'name' => 'время погрустить',
                'location' => 'парк',
                'description' => 'для тех кому нечем заняться',
                'date_start' => '2021-04-20',
                'date_end' => '2021-04-20',
                'time_start' => '12:00',
                'time_end' => '14:00',
                'user_id' => 1,
            ],
        ]);
    }
}
