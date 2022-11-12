<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData()
    {
        $data = [];
        $faker = Faker\Factory::create('ru_RU');

        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'title' => 'Новость ' . $i,
                'text' => $faker->realText(rand(200, 700)),
                'isPrivate' => false,
                'image' => null,
                'category_id' => rand(1, 7),
                'slug' => 'news' . $i,
            ];
        }

        return $data;
    }
}
