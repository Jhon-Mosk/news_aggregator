<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.news.categories', ['categories' => $categories]);
    }

    public function showCategoryNews($slug)
    {
        $category = Category::query()->where('slug', $slug)->first();

        return view('admin.news.category', [
            'category' => $category,
            'news' => $category->newsAllPaginate()
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

        return view('admin.news.one', ['news' => $news]);
    }

    public function create(News $news)
    {
        $categories = Category::all();

        return view('admin.news.create', [
            'news' => $news,
            'categories' => $categories
        ]);
    }

    private function upsertNews($request, $news, $action)
    {
        $request->flash();

        $url = null;

        if ($request->file('image')) {
            $path = Storage::putFile('public/img', $request->file('image'));
            $url = Storage::url($path);
        }

        $category_id = intval($request->category_id);

        $news->image = $url;
        $news->category_id = $category_id;

        ($action === 'save') ? $news->fill($request->all())->save() : $news->fill($request->all())->update();

        $newsSlug = 'news' . $news->id;

        $news->slug = $newsSlug;
        ($action === 'save') ? $news->save() : $news->update();

        $categorySlug = Category::query()
            ->select('slug')
            ->where('id', $category_id)
            ->first();

        return redirect()
            ->route('admin.news.oneNews', [$categorySlug->slug, $newsSlug])
            ->with('success', ($action === 'save') ? 'Новость успешно добавлена' : 'Новость успешно изменена');
    }

    public function store(Request $request, News $news)
    {
        return $this->upsertNews($request, $news, 'save');
    }

    public function destroy(News $news)
    {
        $news->delete();

        $categories = Category::all();

        return redirect()
            ->route('admin.news.categories', ['categories' => $categories])
            ->with('success', 'Новость успешно удалена');
    }

    public function edit(News $news)
    {
        $categories = Category::all();

        return view('admin.news.create', [
            'news' => $news,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, News $news)
    {
        return $this->upsertNews($request, $news, 'update');
    }

    public function downloadJson()
    {
        return response()->json(News::all())
            ->header('Content-Disposition', 'attacment; filename = "news.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function downloadImage()
    {
        return response()->download('build/assets/1.9b20b88a.jpg');
    }
}
