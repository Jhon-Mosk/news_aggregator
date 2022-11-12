<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_page_exist()
    {
        $response = $this->get('/news/categories');

        $response->assertStatus(200);
    }

    public function test_see_header()
    {
        $response = $this->get('/news/categories');

        $response->assertSee('Категории новостей');
    }
}
