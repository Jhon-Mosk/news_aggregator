<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $i = uniqid();

        return [
            'title' => 'Новость ' . $i,
            'text' => fake()->realText(rand(200, 700)),
            'isPrivate' => rand(0, 1),
            'image' => null,
            'category_id' => rand(1, 7),
            'slug' => 'news' . $i,
        ];
    }
}
