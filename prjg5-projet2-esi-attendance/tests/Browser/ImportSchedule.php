<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ImportSchedule extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_received_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/import_groups_for_students')
                    ->assertSee('Importer');
        });
    }
}
