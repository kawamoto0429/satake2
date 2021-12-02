<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('makers')->insert([
            [
                'name' => 'ヤマザキ'
            ],
            [
                'name' => '神戸屋'
            ],
            [
                'name' => 'フジパン'
            ],
            [
                'name' => 'パスコ'
            ]
        ]);
    }
}
