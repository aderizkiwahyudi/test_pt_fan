<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Ananda Bayu',
                'email' => 'bayu@email.com',
                'npp' => '12345',
                'npp_supervisor' => '11111',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Supervisor',
                'email' => 'supervisor@email.com',
                'npp' => '11111',
                'npp_supervisor' => '',
                'password' => bcrypt('password'),
            ]
        ]);
    }
}
