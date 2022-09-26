<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class studentsManagementTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group studentManagement
     * @return void
     */
    public function testSeeTableStudents()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/students_management')
                ->assertSeeIn('@id_student10000', '10000 Letest Mathieu')
                ->assertSeeIn('@id_student20000', '20000 Retest Guillaume');
        });
    }

     /**
     * A Dusk test example.
     * @group studentManagement
     * @return void
     */
    public function testAddStudent()
   {
       $this->browse(function (Browser $browser) {
           $browser->visit('/students_management')
               ->assertSee('Ajouter un étudiant')
               ->press('@popupForm')
               ->type('@student_id', '99999')
               ->type('@student_first_name', 'Hubert')
               ->type('@student_last_name', 'Bonnisseur')
               ->select('@group_name', 'E11')
               ->press('@add')
               ->assertVisible('@id_student99999')
               ->press('@delete99999')
               ->acceptDialog();
       });
   }

    /**
     * A Dusk test example.
     * @group studentManagement
     * @return void
     */
   public function testDelete()
   {
       $this->browse(function (Browser $browser) {
           $browser->visit('/students_management')
               ->press('@delete20000')
               ->acceptDialog()
               ->assertMissing('@id_student20000')
               ->press('@popupForm')
               ->type('@student_id', '20000')
               ->type('@student_first_name', 'Guillaume')
               ->type('@student_last_name', 'Retest')
               ->select('@group_name', 'E12')
               ->press('@add');
       });
   }
}
