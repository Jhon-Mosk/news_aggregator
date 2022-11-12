<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')
            ->get();

        return view('news.categories', ['categories' => $categories]);
    }

    public function showCategoryNews($slug)
    {
        $category = DB::table('categories')
            ->where('slug', $slug)
            ->first();

        $news = DB::table('news')
            ->where('category_id', $category->id ?? null)
            ->get();

        return view('news.category', [
            'category' => $category,
            'news' => $news
        ]);
    }

    public function showOneNews($categorySlug, $newsSlug)
    {
        $category = DB::table('categories')
            ->where('slug', $categorySlug)
            ->first();

        $news = DB::table('news')
            ->where('slug', $newsSlug)
            ->where('category_id', $category->id ?? null)
            ->first();

        return view('news.one', ['news' => $news]);
    }
}
