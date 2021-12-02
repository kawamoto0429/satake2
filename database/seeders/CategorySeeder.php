<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => '菓子パン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
            ],
            [
                'name' => '袋パン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
            ],
            [
                'name' => '食パン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
            ],
            [
                'name' => '洋菓子',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
            ],
            [
                'name' => '菓子パン',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
            ],
            [
                'name' => '袋パン',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
            ],
            [
                'name' => '食パン',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
            ],
            [
                'name' => '菓子パン',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
            ],
            [
                'name' => '袋パン',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
            ],
            [
                'name' => '食パン',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
            ],
            [
                'name' => '菓子パン',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
            ],
            [
                'name' => '袋パン',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
            ],
            [
                'name' => '食パン',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
            ],
            
            ]);
    }
}
