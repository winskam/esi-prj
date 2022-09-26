<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CSVGroupsTest extends DuskTestCase
{
    /**
     * Checks if the group assignments page sends back a success message when a valid CSV file is given as input.
     * (Mights break because of primary key constraint. To be used with real instead of mock data.)
     */
    public function test_csv_success()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/import_groups_for_students')
                    ->attach('studentsGroupsCSV', 'public/testAffectations.csv')
                    ->press('Importer le fichier')
                    ->assertVisible('.success');
        });
    }

    /**
     * Checks if the group assignements page sends back an error when a wrong CSV file is given as input.
     */
    public function test_csv_error()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/import_groups_for_students')
                    ->attach('studentsGroupsCSV', 'public/testAffectationsInvalides.docx')
                    ->press('Importer le fichier')
                    ->assertVisible('.error');
        });
    }
}
