<?php

namespace Database\Seeders;

use App\Models\Reminder;
use Illuminate\Database\Seeder;

class ReminderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Reminder::factory(1)->create();
        \App\Models\Reminder::insert([
            [
                'name' => 'купить продукты',
                'date' => '2021-05-16',
                'time' => '10:00',
                'repeat' => 'не повторять',
                'user_id' => 1,
            ],
            [
                'name' => 'у тебя склероз, но ты об этом постоянно забываешь',
                'date' => '2021-04-16',
                'time' => '07:00',
                'repeat' => 'ежедневно',
                'user_id' => 1,
            ],
            [
                'name' => 'сегодня выходной',
                'date' => '2021-05-22',
                'time' => '08:00',
                'repeat' => 'не повторять',
                'user_id' => 1,
            ],
            [
                'name' => 'защита спринта',
                'date' => '2021-04-30',
                'time' => '18:30',
                'repeat' => 'еженедельно',
                'user_id' => 1,
            ],
            [
                'name' => 'кружок у ребенка',
                'date' => '2021-05-29',
                'time' => '15:00',
                'repeat' => 'еженедельно',
                'user_id' => 1,
            ],
            [
                'name' => 'лето наступило если что',
                'date' => '2021-06-01',
                'time' => '07:00',
                'repeat' => 'каждый год',
                'user_id' => 1,
            ],
        ]);
    }
}
