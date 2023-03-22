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
            'name' => 'PanitiaAKL1',
            'email' => 'panitiaakl1@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaAKL2',
            'email' => 'panitiaakl2@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaOTKP1',
            'email' => 'panitiaotkp1@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaOTKP2',
            'email' => 'panitiaotkp2@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaBDP1',
            'email' => 'panitiabdp1@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'PanitiaBDP2',
            'email' => 'panitiabdp2@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
