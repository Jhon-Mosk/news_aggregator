<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserController extends Controller
{
    public function index()
    {
        $xml = XMLParser::load('https://lenta.ru/rss');
        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'news' => ['uses' => 'channel.item[guid,title,link,description,pubDate,enclosure::url,category]'],
        ]);

        foreach ($data['news'] as $item) {
            $category = Category::firstOrCreate([
                'name' => $item['category'],
                'slug' => Str::of($item['category'])->slug('-'),
            ]);

            $news = News::query()->firstOrCreate([
                'title' => $item['title'],
                'text' => $item['description'],
                'image' => $item['enclosure::url'],
                'isPrivate' => rand(0, 1),
                'category_id' => $category->id,
                'guid' => $item['guid'],
                'link' => $item['link'],
                'pubDate' => date_create($item['pubDate']),
            ]);

            $news->slug = 'news' . $news->id;
            $news->save();
        }

        return redirect()
            ->route('admin.news.categories')
            ->withSuccess('Парсин прошёл успешно');
    }
}
