<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddCategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test1Example()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/create')
                ->type('name', '1')
                ->press('Добавить категорию')
                ->assertSee('Название коротковато. Минимум 5 символов.');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test2Example()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/create')
                ->type('name', 'wwwwwwwwwwwwwwwwwwwwwwwwww')
                ->press('Добавить категорию')
                ->assertSee('Перебор. Максимум 20 символов.');
        });
    }
}
