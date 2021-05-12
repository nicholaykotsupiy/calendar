<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Task::factory(1)->create();
        \App\Models\Task::insert([
            [
                'name' => 'выполнить задачи на спринт',
                'description' => 'умри но сделай',
                'date_start' => '2021-05-10',
                'date_end' => '2021-05-14',
                'time_start' => '08:00',
                'time_end' => '12:00',
                'all_day' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'выйди погуляй!',
                'description' => 'ты улицу хоть видишь?',
                'date_start' => '2021-05-02',
                'date_end' => '2021-05-02',
                'time_start' => '12:00',
                'time_end' => '15:00',
                'all_day' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'всем работать!',
                'description' => 'а вы как думали?',
                'date_start' => '2021-04-29',
                'date_end' => '2021-04-29',
                'time_start' => '08:00',
                'time_end' => '17:00',
                'all_day' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'снова всем работать!',
                'description' => 'а вы как думали?',
                'date_start' => '2021-05-17',
                'date_end' => '2021-05-17',
                'time_start' => '08:00',
                'time_end' => '17:00',
                'all_day' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'еще какая-то задача',
                'description' => 'фантазия уже закончилась',
                'date_start' => '2021-05-18',
                'date_end' => '2021-05-18',
                'time_start' => '08:00',
                'time_end' => '12:00',
                'all_day' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'прокачать фантазию',
                'description' => 'да, пора бы уже',
                'date_start' => '2021-06-21',
                'date_end' => '2021-06-21',
                'time_start' => '08:00',
                'time_end' => '09:00',
                'all_day' => 0,
                'user_id' => 1,
            ],
        ]);
    }
}
