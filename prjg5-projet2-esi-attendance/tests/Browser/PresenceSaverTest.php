<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PresenceSaverTest extends DuskTestCase
{
    /**
     * Checks if you can check all checkboxes at once using the "check all" button.
     */
    public function test_check_all()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/seance-details/1')
                    ->check("@select-all")
                    ->assertChecked("@select-all")
                    ->assertChecked("@54259");
        });
    }

    /**
     * Checks if in normal conditions, the success message is returned.
     */
    public function test_validate()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/seance-details/1')
                    ->check("@select-all")
                    ->press("Valider les présences")
                    ->assertUrlIs("https://esi-attendance-johnlom.herokuapp.com/seance-details/1/validation")
                    ->assertPresent("@success");
        });
    }

}
