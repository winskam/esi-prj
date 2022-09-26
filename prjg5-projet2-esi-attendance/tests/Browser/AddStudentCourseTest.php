<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddStudentCourseTest extends DuskTestCase
{
    public function testAddStudent1(){
        $this->browse(function (Browser $browser){
            $browser->visit('/seance-details/1')
                ->select('@select_student_id', '20000')
                ->press('Ajouter')
                ->assertUrlIs('http://esi-attendance-johnlom.herokuapp.com/seance-details/1');
        });
    }

    public function testDeleteStudent1(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/seance-details/1')
                ->press('@button_delete20000')
                ->assertUrlIs('http://esi-attendance-johnlom.herokuapp.com/seance-details/1/delete/20000');
        });
    }
}
