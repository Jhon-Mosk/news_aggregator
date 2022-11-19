<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function createNews(Request $request, Categories $categories, News $news)
    {
        if ($request->isMethod('POST')) {
            $request->flash();

            $url = null;

            if ($request->file('image')) {
                $path = Storage::putFile('public/img', $request->file('image'));
                $url = Storage::url($path);
            }

            $incomingData = $request->except('_token');
            $category_id = intval($incomingData['category_id']);

            $id = DB::table('news')->insertGetId([
                'title' => $incomingData['title'],
                'category_id' => $category_id,
                'text' => $incomingData['text'],
                'image' => $url,
                'isPrivate' => array_key_exists('isPrivate', $incomingData),
            ]);

            $newsSlug = 'news' . $id;

            DB::table('news')
                ->where('id', $id)
                ->update([
                    'slug' => $newsSlug
                ]);

            $categorySlug = DB::table('categories')
                ->select('slug')
                ->where('id', $category_id)
                ->first();

            return redirect()
                ->route('news.oneNews', [$categorySlug->slug, $newsSlug])
                ->with('success', 'Новость успешно добавлена');
        }

        $categories = DB::table('categories')
            ->get();

        return view('admin.createNews', [
            'categories' => $categories
        ]);
    }

    public function downloadJson(News $news)
    {
        return response()->json($news->getNews())
            ->header('Content-Disposition', 'attacment; filename = "news.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function downloadImage()
    {
        return response()->download('build/assets/1.9b20b88a.jpg');
    }
}
