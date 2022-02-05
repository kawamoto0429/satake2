<?php

namespace Database\Seeders;

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
                'name' => "test1",
                'email' => "test1@gmail.com",
                'password' => bcrypt('test1test1'),
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => "test2",
                'email' => "test2@gmail.com",
                'password' => bcrypt('test2test1'),
            ],
        ]);
    }
}
