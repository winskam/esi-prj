<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Group;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class studentsManagementTest extends TestCase {

    /**
    * Test to add a student.
    */

    public function test_add_student_when_successful() {
        if ( !empty( Student::selectStudent( 53212 ) ) ) {
            Student::deleteStudent( 53212 );
        }
        Student::add( 53212, 'Mols', 'Leopold', 'E11' );
        $this->assertDatabaseHas( 'students', [
            'id' => 53212,
            'first_name' => 'Leopold',
            'last_name' => 'Mols',
        ] );
        $this->assertDatabaseHas( 'student_groups', [
            // 'id' => 3,
            'student_id' => 53212,
            'group_name' => 'E11',
        ] );
    }

    /**
    * Test to add a student who already exist.
    *
    * @throws Exception expection exception
    */

    public function test_add_Student_when_already_exists() {
        $this->expectException( QueryException::class );
        Student::add( 53212, 'Leopold', 'Mols', 'E11' );
    }

    /**
    * Test to add a student with a negative id.
    *
    * @throws Exception expection exception
    */

    public function test_add_Student_when_negative_id() {
        Student::add( -1, 'Leopold', 'Mols', 'E11' );
        $this->assertDatabaseMissing( 'students', [
            'id' => -1,
        ] );
    }

    /**
    * Test to add a student without group.
    *
    * @throws Exception expection exception
    */

    public function test_add_Student_when_no_group() {
        $this->expectException( QueryException::class );
        Student::add( 53212, '', 'Mols', 'E11' );
    }

    /**
    * Test to add a student without first name or last name.
    *
    * @throws Exception expection exception
    */

    public function test_add_Student_when_first_or_last_name_empty() {
        $this->expectException( QueryException::class );
        Student::add( 53212, '', 'Mols', 'E11' );
    }

    /**
    * Test the delete of a student.
    */

    public function test_delete_student() {
        if ( empty( Student::selectStudent( 30000 ) ) ) {
            if ( empty( Group::findGroup( 'E12' ) ) )
                DB::insert( 'insert into groups (name) values (?)', [ 'E12' ] );
            DB::insert( 'insert into students (id, last_name, first_name) values (?, ?, ?)', [ 30000, 'aerg', 'qefb' ] );
            DB::insert( 'insert into student_groups (student_id, group_name) values (?, ?)', [ 30000, 'E12' ] );
        }
        $this->assertDatabaseHas( 'students', [
            'id' => 30000,
        ] );

        Student::deleteStudent( 30000 );

        $this->assertDatabaseMissing( 'students', [
            'id' => 30000,
        ] );

        $this->assertDatabaseMissing( 'student_groups', [
            'student_id' => 30000,
        ] );
    }
}
