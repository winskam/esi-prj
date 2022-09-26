<?php

namespace Tests\Unit;

use Tests\TestCase;
use \Illuminate\Support\Facades\DB;

use App\Models\Student;
use App\Queries;
use App\Models\PresenceFormatter;

class PresenceSaverTest extends TestCase {
    public function test_insert_presences() {
        if ( empty( Student::selectStudent( 1 ) ) ) {
            Student::add( 1, 'la poulette ?', 'Elle est où ', 'E11' );
        }
        $success = False;

        $testPresences = [
            [
                'seance_id' => 1,
                'student_id' => 10000,
                'is_present' => true
            ]
        ];
        Queries::insertPresences( $testPresences );

        $presences = DB::table( 'presences' )->get();
        foreach ( $presences as $presence ) {
            if ( $presence->seance_id == $testPresences[ 0 ][ 'seance_id' ]
            && $presence->student_id == $testPresences[ 0 ][ 'student_id' ]
            && $presence->is_present == $testPresences[ 0 ][ 'is_present' ] ) {
                $success = True;
                break;
            }
        }

        $this->assertTrue( $success );
        Student::deleteStudent( 1 );
    }

    public function test_format_presences() {
        $success = false;

        $studentsIds = [43009];
        $seanceId = 1;

        $presences = PresenceFormatter::savePresences( $studentsIds, $seanceId );
        foreach ( $presences as $presence ) {
            if ( $presence == [ 'seance_id' => $seanceId, 'student_id' => $studentsIds[ 0 ], 'is_present' => true ] ) {
                $success = true;
                break;
            }
        }

        $this->assertTrue( $success );
    }
}
