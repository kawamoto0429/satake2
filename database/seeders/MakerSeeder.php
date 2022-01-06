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
                'name' => 'ヤマザキ',
                'imgpath' => 'yamazaki.gif',
            ],
            [
                'name' => '神戸屋',
                'imgpath' => 'koubeya.png',
            ],
            [
                'name' => 'フジパン',
                'imgpath' => 'huzipan.png',
            ],
            [
                'name' => 'パスコ',
                'imgpath' => 'pasuco.png',
            ]
        ]);
    }
}
