<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\Models\NewsSource;
use Illuminate\Support\Facades\Artisan;

class ParserController extends Controller
{
    public function index()
    {
        $rssLinks = NewsSource::all();

        foreach ($rssLinks as $link) {
            NewsParsing::dispatch($link->link);
        }

        return redirect()
            ->route('admin.news_sources.index')
            ->withSuccess('Источники добавлены в очередь на выполнение');
    }

    public function parse()
    {
        Artisan::call('queue:listen');

        return redirect()
            ->route('admin.news_sources.index')
            ->withSuccess('Парсинг запущен');
    }
}
