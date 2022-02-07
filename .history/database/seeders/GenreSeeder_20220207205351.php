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
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'ランチパック',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'ドーナツステーション',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '惣菜パン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'ミニパン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '日々カフェ',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'パングルメ',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '薄皮',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '高級シリーズ',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'サンドぱん',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],

            [
                'name' => '菓子パン（その他）',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 1,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '蒸しパン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'クロワッサン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'ルヴァン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'ドーナツ',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'マルチパックシリーズ',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => '食卓ロール',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'ロイヤル',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'スナックスティック',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'スイスケーキ',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'BAKEONE',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => 'テーブル食卓パン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => '袋パン（その他）',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 2,
                'category_name' => '袋パン',
            ],
            [
                'name' => '超芳醇',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => 'ダブルソフト',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => '新書館宣言',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => 'ふんわり',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => 'ロイヤルブレッド',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => 'ゴールドシリーズ',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => 'ユアクイーン',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => '食パン（その他）',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 3,
                'category_name' => '食パン',
            ],
            [
                'name' => '洋菓子（その他）',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 4,
                'category_name' => '洋菓子',
            ],
            [
                'name' => '和菓子（その他）',
                'maker_id' => 1,
                'maker_name' => 'ヤマザキ',
                'category_id' => 5,
                'category_name' => '和菓子',
            ],
            [
                'name' => 'フランスシリーズ',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
                'category_id' => 6,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '丹念熟成',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
                'category_id' => 6,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '惣菜パン',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
                'category_id' => 6,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '菓子パン（その他）',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
                'category_id' => 6,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '袋パン（その他）',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
                'category_id' => 7,
                'category_name' => '袋パン',
            ],
            [
                'name' => '食パン（その他）',
                'maker_id' => 2,
                'maker_name' => '神戸屋',
                'category_id' => 8,
                'category_name' => '食パン',
            ],
            [
                'name' => 'スナックサンド',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
                'category_id' => 9,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'ちっちゃいシリーズ',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
                'category_id' => 9,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'アンパンマンパン',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
                'category_id' => 9,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '惣菜パン',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
                'category_id' => 9,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '菓子パン（その他）',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
                'category_id' => 9,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '袋パン（その他）',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
                'category_id' => 10,
                'category_name' => '袋パン',
            ],
            [
                'name' => '食パン（その他）',
                'maker_id' => 3,
                'maker_name' => 'フジパン',
                'category_id' => 11,
                'category_name' => '食パン',
            ],
            [
                'name' => '惣菜パン',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
                'category_id' => 12,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '窯焼きパン',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
                'category_id' => 12,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '菓子パン（その他）',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
                'category_id' => 13,
                'category_name' => '菓子パン',
            ],
            [
                'name' => '食卓パン',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
                'category_id' => 13,
                'category_name' => '袋パン',
            ],

            [
                'name' => '袋パン（その他）',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
                'category_id' => 13,
                'category_name' => '袋パン',
            ],
            [
                'name' => '超熟食パン',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
                'category_id' => 14,
                'category_name' => '食パン',
            ],
            [
                'name' => '食パン（その他）',
                'maker_id' => 4,
                'maker_name' => 'パスコ',
                'category_id' => 14,
                'category_name' => '菓子パン',
            ],
            [
                'name' => 'ラベル',
                'maker_id'=> 1,
                'maker_name'=> 'ヤマザキ',
                'category_id'=> 1,
                'category_name'=> '菓子パン',
            ],
            [
                'name' => '中華まん',
                'maker_id'=> 1,
                'maker_name'=> 'ヤマザキ',
                'category_id'=> 2,
                'category_name'=> '袋パン',
            ],
            [
                'name' => '菓子ケーキ',
                'maker_id'=> 1,
                'maker_name'=> 'ヤマザキ',
                'category_id'=> 1,
                'category_name'=> '菓子パン',
            ],
            [
                'name' => '食卓パン',
                'maker_id'=> 3,
                'maker_name'=> 'ヤマザキ',
                'category_id'=> 10,
                'category_name'=> '菓子パン',
            ]



        ]);
    }
}
