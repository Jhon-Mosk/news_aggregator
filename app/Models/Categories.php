<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Categories
{
    private $categories = [
        1 => [
            'id' => 1,
            'name' => 'Политика',
            'slug' => 'politics'
        ],
        2 => [
            'id' => 2,
            'name' => 'В мире',
            'slug' => 'world'
        ],
        3 => [
            'id' => 3,
            'name' => 'Экономика',
            'slug' => 'economy'
        ],
        4 => [
            'id' => 4,
            'name' => 'Общество',
            'slug' => 'society'
        ],
        5 => [
            'id' => 5,
            'name' => 'Проишествия',
            'slug' => 'incidents'
        ],
        6 => [
            'id' => 6,
            'name' => 'Безопасность',
            'slug' => 'defense_safety'
        ],
        7 => [
            'id' => 7,
            'name' => 'Наука',
            'slug' => 'science'
        ]
    ];

    public function getCategories()
    {
        return json_decode(File::get(storage_path() . '/app/news/categories.json'), true);
    }

    public function getCategoryById($id)
    {
        return (json_decode(File::get(storage_path() . '/app/news/categories.json'), true))[$id];
    }

    public function getOneCategory($slug)
    {
        foreach ($this->getCategories() as $category) {
            if ($category['slug'] == $slug) {
                return $category;
            }
        }

        return [];
    }
}
