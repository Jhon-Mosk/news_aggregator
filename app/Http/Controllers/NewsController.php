<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('news.categories', ['categories' => $categories]);
    }

    public function showCategoryNews($slug)
    {
        $category = Category::query()->where('slug', $slug)->first();

        return view('news.category', [
            'category' => $category,
            'news' => $category->news()->orderBy('pubDate', 'desc')->paginate(5)
        ]);
    }

    public function showOneNews($categorySlug, $newsSlug)
    {
        $category = Category::query()
            ->where('slug', $categorySlug)
            ->first();

        $news = News::query()
            ->where('slug', $newsSlug)
            ->where('category_id', $category->id ?? null)
            ->first();

        return view('news.one', ['news' => $news]);
    }
}
