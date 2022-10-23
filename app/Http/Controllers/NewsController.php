<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $categories = Categories::getCategories();

        return view('news.categories', ['categories' => $categories]);
    }

    public function showCategoryNews($slug)
    {
        $category = Categories::getOneCategory($slug);
        $news = News::getCategoryNews($category['id']);

        return view('news.category', ['category' => $category, 'news' => $news]);
    }

    public function showOneNews($categorySlug, $newsSlug)
    {
        $category = Categories::getOneCategory($categorySlug);
        $news = News::getOneNews($category, $newsSlug);

        return view('news.one', ['news' => $news]);
    }
}
