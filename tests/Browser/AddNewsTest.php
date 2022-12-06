<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddNewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test1Example()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->type('title', '1')
                ->type('text', '11')
                ->check('isPrivate')
                ->press('Добавить новость')
                ->assertSee('Заголовок коротковат. Минимум 5 символов.')
                ->assertSee('Количество символов в поле Текст должно быть не меньше 5.');
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
            $browser->visit('/admin/news/create')
                ->type('title', '111111')
                ->type('text', '1123444444442342354235')
                ->press('Добавить новость')
                ->assertSee('Новость успешно добавлена')
                ->press('Удалить')
                ->assertSee('Новость успешно удалена')
                ->assertPathIs('/admin/news/categories');
        });
    }
}
