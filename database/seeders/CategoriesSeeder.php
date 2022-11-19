<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            1 => [
                'id' => 1,
                'name' => "Политика",
                'slug' => "politics"
            ],
            2 => [
                'id' => 2,
                'name' => "В мире",
                'slug' => "world"
            ],
            3 => [
                'id' => 3,
                'name' => "Экономика",
                'slug' => "economy"
            ],
            4 => [
                'id' => 4,
                'name' => "Общество",
                'slug' => "society"
            ],
            5 => [
                'id' => 5,
                'name' => "Проишествия",
                'slug' => "incidents"
            ],
            6 => [
                'id' => 6,
                'name' => "Безопасность",
                'slug' => "defense_safety"
            ],
            7 => [
                'id' => 7,
                'name' => "Наука",
                'slug' => "science"
            ]
        ]);
    }
}
