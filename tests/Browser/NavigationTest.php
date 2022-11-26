<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NavigationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test3Example()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/categories');
            if ($browser->seeLink('Политика')) {
                $browser->clickLink('Политика')
                    ->assertPathIs('/admin/news/politics');
            }
        });
    }
}
