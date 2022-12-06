<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsSourceRequest;
use App\Models\NewsSource;
use Illuminate\Http\Request;

class NewsSourceController extends Controller
{
    public function index()
    {
        return view('admin.news.sources.index', [
            'sources' => NewsSource::all(),
        ]);
    }

    public function create(NewsSource $newsSource)
    {
        return view('admin.news.sources.create', ['source' => $newsSource]);
    }

    public function store(NewsSourceRequest $request, NewsSource $newsSource)
    {
        return $this->upsertCategory($request, $newsSource, 'save');
    }

    public function edit(NewsSource $newsSource)
    {
        return view('admin.news.sources.create', ['source' => $newsSource]);
    }

    public function update(NewsSourceRequest $request, NewsSource $newsSource)
    {
        return $this->upsertCategory($request, $newsSource, 'update');
    }

    private function upsertCategory($request, $newsSource, $action)
    {
        $request->flash();

        $request->validated();

        $newsSource->fill($request->all())->save();

        return redirect()
            ->route('admin.news_sources.index')
            ->with('success', ($action === 'save') ? 'Источник успешно добавлен' : 'Источник успешно изменен');
    }

    public function destroy(NewsSource $newsSource)
    {
        $newsSource->delete();

        return redirect()
            ->route('admin.news_sources.index', ['sources' => NewsSource::all()])
            ->with('success', 'Источник успешно удалён');
    }
}
