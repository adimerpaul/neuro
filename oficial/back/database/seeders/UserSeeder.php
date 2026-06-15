<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
//                'name' => 'Evelyn Giovana Ramirez Cube',
                'firstName' => 'Evelyn',
                'secondName' => 'Giovana',
                'lastName' => 'Ramirez',
                'secondLastName' => 'Cube',
                'email' => 'admin@test.com',
                'profession' => 'Administrador',
                'ci' => '123456',
                'password' => bcrypt('123456')
            ],

        ]);
    }
}
