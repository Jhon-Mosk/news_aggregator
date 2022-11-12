<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class News
{
    public function getNews()
    {
        return json_decode(File::get(storage_path() . '/app/news/news.json'), true);
    }

    public function getOneNews($category, $newsSlug)
    {
        foreach ($this->getNews() as $news) {
            if ($news['slug'] == $newsSlug && $category['id'] == $news['category_id']) {
                return $news;
            }
        }

        return [];
    }

    public function getCategoryNews($category_id)
    {
        $result = [];

        foreach ($this->getNews() as $news) {
            if ($news['category_id'] == $category_id) {
                $result[] = $news;
            }
        }

        return $result;
    }
}
