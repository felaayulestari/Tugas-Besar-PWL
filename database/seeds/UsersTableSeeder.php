<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Fela Ayu Lestari',
            'username' => 'felaal',
            'password' => bcrypt('password'),
            'email' => 'felaayulestari4940@gmail.com',
        ]);
    }
}
