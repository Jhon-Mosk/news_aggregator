<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Str;

class XMLParserService
{
    public function saveNews($link)
    {
        $xml = XMLParser::load($link);
        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'news' => ['uses' => 'channel.item[guid,title,link,description,pubDate,enclosure::url,category]'],
        ]);

        foreach ($data['news'] as $item) {
            if (is_array($item['category'])) {
                $item['category'] = null;
            }

            $category = Category::firstOrCreate([
                'name' => $item['category'] ?? 'Другое',
                'slug' => Str::of($item['category'] ?? 'Другое')->slug('-'),
            ]);

            $news = News::query()->firstOrCreate([
                'title' => $item['title'],
                'text' => $item['description'] ?? 'Текст новости отсутствует',
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

        $fileName = sprintf('logs%s.txt', time() . rand(0, 10000));
        Storage::disk('publicLogs')->put($fileName, $link);
    }
}
