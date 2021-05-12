<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Guest::factory(5)->create();
        \App\Models\Guest::insert([
            [
                'mail' => 'nnn@mail.ru',
                'event_id' => 1,
            ],
            [
                'mail' => 'lisa@mail.ru',
                'event_id' => 1,
            ],
            [
                'mail' => 'ooooooo.llll@gmail.com',
                'event_id' => 1,
            ],
            [
                'mail' => 'pppppp.lll@mail.ru',
                'event_id' => 2,
            ],
            [
                'mail' => 'olia@gmail.com',
                'event_id' => 2,
            ],
            [
                'mail' => 'ooooooo.llll@gmail.com',
                'event_id' => 3,
            ],
            [
                'mail' => 'lisa@mail.ru',
                'event_id' => 3,
            ],
            [
                'mail' => 'papa@gmail.com',
                'event_id' => 4,
            ],
            [
                'mail' => 'mama@mail.ru',
                'event_id' => 4,
            ],
            [
                'mail' => 'ololo@gmail.com',
                'event_id' => 5,
            ],
            [
                'mail' => 'iiiiii@mail.ru',
                'event_id' => 5,
            ],
            [
                'mail' => 'iiiiii@gmail.com',
                'event_id' => 6,
            ],
            [
                'mail' => 'mmmmmmm@mail.ru',
                'event_id' => 6,
            ],
        ]);
    }
}
