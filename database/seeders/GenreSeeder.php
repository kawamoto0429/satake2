<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'name' => '蒸しパン',
                'maker_id' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'ランチパック',
                'maker_id' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'ドーナツ',
                'maker_id' => 1,
                'category_id' => 1,
            ],
            [
                'name' => '惣菜パン',
                'maker_id' => 1,
                'category_id' => 1,
            ],
            
            
        ]);
    }
}
