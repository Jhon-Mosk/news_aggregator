<?php

namespace App\Models;

class Categories
{
    private static $categories = [
        [
            'id' => 1,
            'name' => 'Политика',
            'slug' => 'politics'
        ],
        [
            'id' => 2,
            'name' => 'В мире',
            'slug' => 'world'
        ],
        [
            'id' => 3,
            'name' => 'Экономика',
            'slug' => 'economy'
        ],
        [
            'id' => 4,
            'name' => 'Общество',
            'slug' => 'society'
        ],
        [
            'id' => 5,
            'name' => 'Проишествия',
            'slug' => 'incidents'
        ],
        [
            'id' => 6,
            'name' => 'Безопасность',
            'slug' => 'defense_safety'
        ],
        [
            'id' => 7,
            'name' => 'Наука',
            'slug' => 'science'
        ]
    ];

    public static function getCategories()
    {
        //dump(Str::slug('Новсть 1'))
        return static::$categories;
    }

    public static function getOneCategory($slug)
    {
        foreach (Categories::getCategories() as $category) {
            if ($category['slug'] == $slug) {
                return $category;
            }
        }

        return [];
    }
}
