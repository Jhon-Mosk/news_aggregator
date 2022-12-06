<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_sources')->insert([
            [
                'link' => 'https://lenta.ru/rss',
            ],
            [
                'link' => 'https://www.vedomosti.ru/rss/news',
            ],
            [
                'link' => 'https://tass.ru/rss/anews.xml?sections=NDczMA%3D%3D',
            ],
        ]);
    }
}
