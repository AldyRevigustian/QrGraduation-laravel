<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'PanitiaRPL',
            'email' => 'panitiarpl@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaAKL',
            'email' => 'panitiaakl@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaAKL',
            'email' => 'panitiaotkp@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaBDP',
            'email' => 'panitiabdp@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
