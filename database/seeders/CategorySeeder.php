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
                'name' => '菓子パン'
            ],
            [
                'name' => '袋パン'
            ],
            [
                'name' => '食パン'
            ],
            [
                'name' => '洋菓子'
            ],
            ]);
    }
}
