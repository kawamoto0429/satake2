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
            ],
            [
                'name' => '袋パン',
                'maker_id' => 1,
            ],
            [
                'name' => '食パン',
                'maker_id' => 1,
            ],
            [
                'name' => '洋菓子',
                'maker_id' => 1,
            ],
            [
                'name' => '菓子パン',
                'maker_id' => 2,
            ],
            [
                'name' => '袋パン',
                'maker_id' => 2,
            ],
            [
                'name' => '食パン',
                'maker_id' => 2,
            ],
            [
                'name' => '菓子パン',
                'maker_id' => 3,
            ],
            [
                'name' => '袋パン',
                'maker_id' => 3,
            ],
            [
                'name' => '食パン',
                'maker_id' => 3,
            ],
            [
                'name' => '菓子パン',
                'maker_id' => 4,
            ],
            [
                'name' => '袋パン',
                'maker_id' => 4,
            ],
            [
                'name' => '食パン',
                'maker_id' => 4,
            ],
            
            ]);
    }
}
