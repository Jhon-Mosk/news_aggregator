<?php

namespace Tests\Unit;

use App\Models\Categories;
use App\Models\News;
use PHPUnit\Framework\TestCase;

class CategoriesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_categories_is_array()
    {
        $categories = (new Categories())->getCategories();

        $this->assertIsArray($categories);
    }
}
