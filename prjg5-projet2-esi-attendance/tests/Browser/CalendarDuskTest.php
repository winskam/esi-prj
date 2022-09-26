<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CalendarDuskTest extends DuskTestCase
{

    /**
     * Checks if the Calendar page is visitable
     */
    public function test_visit_calendar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/calendar')
                    ->assertSee("Gestion de projet");
        });
    }

    /**
     * Checks if the header is shown or not
     *
     * @return void
     */
    public function test_header_is_shown()
    {
        
        $this->browse(function (Browser $browser) {
            $month = date('m');
            $verbal_month = "";
            switch($month){
                case 1:
                    $verbal_month = "janvier";
                    break;
                case 2:
                    $verbal_month = "février";
                    break;
                case 3:
                    $verbal_month = "mars";
                    break;
                case 4:
                    $verbal_month = "avril";
                    break;
                case 5:
                    $verbal_month = "mai";
                    break;
                case 6:
                    $verbal_month = "juin";
                    break;
                case 7:
                    $verbal_month = "juillet";
                    break;
                case 8:
                    $verbal_month = "août";
                    break;
                case 9:
                    $verbal_month = "septembre";
                    break;
                case 10:
                    $verbal_month = "octobre";
                    break;
                case 11:
                    $verbal_month = "novembre";
                    break;
                case 12:
                    $verbal_month = "décembre";
                    break;
                default: 
                    $verbal_month = "décembre";
            }
            $browser->visit('/calendar')
                    ->assertSee($verbal_month);
        });
    }
}
