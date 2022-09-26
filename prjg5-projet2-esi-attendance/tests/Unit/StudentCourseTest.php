<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;

use App\Models\Student;
use Tests\TestCase;
use App\Models\StudentModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class StudentCourseTest extends TestCase
{
    /**
     * Trying to add an unexisting student
     *
     * @return void
     */
    public function test_add_student_to_course_unexisting_student()
    {
        $this->expectException(QueryException::class);
        StudentModel::addAndUpdateStudentToCourse(1, 1000000, true);
    }

    /**
     * Trying to add a student to an unexisting course
     *
     * @return void
     */
    public function test_add_student_to_course_unexisting_course()
    {
        $this->expectException(QueryException::class);
        StudentModel::addAndUpdateStudentToCourse(1000000, 1, true);
    }

    /**
     * Trying to add an existing student to an existing course
     * Of course, this tests must be executed when there hasn't been
     * any adding of these parameters in the table "exception_student_list" yet
     *
     * @return void
     */
    public function test_add_student_to_course_existing_student_and_course()
    {
        $student = DB::select( '
            SELECT *
            FROM exception_student_list
            WHERE course_id = 1
                AND student_id = 90000
            ORDER BY id ASC
        ' );
        if ( empty( $student ) )
        {
            Student::add(90000, "poiuytreza", "azertyuiop", "E12");
            StudentModel::addAndUpdateStudentToCourse(1, 90000, true);
        }
        $this->assertDatabaseHas('exception_student_list', [
            'student_id' => 90000,
            'course_id' => 1
        ]);
    }

    /**
     * Trying to delete an unexisting student
     *
     * @return void
     */
    public function test_delete_student_from_course_unexisting_student()
    {
        $this->expectException(\Exception::class);
        StudentModel::deleteStudentFromCourse(1, 1000000);
    }

    /**
     * Trying to delete a student from an unexisting course
     *
     * @return void
     */
    public function test_delete_student_from_course_unexisting_course()
    {
        $this->expectException(\Exception::class);
        StudentModel::deleteStudentFromCourse(1000000, 1);
    }

    /**
     * Trying to delete an existing student from an existing course
     *
     * @return void
     */
    public function test_delete_student_from_course_existing_student_and_course()
    {
        $student = DB::select( '
            SELECT *
            FROM exception_student_list
            WHERE course_id = 1
                AND student_id = 90000
            ORDER BY id ASC
        ' );
        if ( empty( $student ) )
        {
            Student::add(90000, "poiuytreza", "azertyuiop", "E12");
            StudentModel::addAndUpdateStudentToCourse(1, 90000, true);
        }
        StudentModel::deleteStudentFromCourse(1, 90000);
        $this->assertDatabaseMissing('exception_student_list', [
            'student_id' => 90000,
            'course_id' => 1
        ]);
    }
}
