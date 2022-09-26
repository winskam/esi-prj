<?php

namespace App;

use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Exception;

/**
 * Handles interactions with the database.
 */
class Queries
{

    public $seance_id;

    public function __construct($seance_id)
    {
        $this->seance_id = $seance_id;
    }

    /**
     * Gets all students who attend at a given seance.
     */
    static public function studentsForSeance($seanceId)
    {
        $students = DB::select("SELECT s.*
                                    FROM students s
                                        JOIN student_groups sg ON s.id = sg.student_id
                                        JOIN courses_groups cg ON sg.group_name = cg.group_id
                                        JOIN seances se ON cg.id = se.course_group
                                    WHERE se.id = ? AND s.id NOT IN (SELECT esl.student_id
                                                                        FROM seances se
                                                                            JOIN courses_groups cg ON se.course_group = cg.id
                                                                            JOIN exception_student_list esl ON cg.course_id = esl.course_id
                                                                        WHERE se.id = ? AND esl.state = 0)
                                UNION
                                -- plus exceptions
                                SELECT s.*
                                    FROM seances se
                                        JOIN courses_groups cg ON se.course_group = cg.id
                                        JOIN exception_student_list esl ON cg.course_id = esl.course_id
                                        JOIN students s ON esl.student_id = s.id
                                    WHERE se.id = ? AND esl.state = 1", [$seanceId, $seanceId, $seanceId]);
        return $students;
    }

    /**
     * Inserts into the database the group assignment for each student.
     * Beforehand, clears the stored assignments to avoid conflict and keeping outdated information.
     */
    static public function insertGroupsForStudents($data)
    {
        DB::table('student_groups')->delete();
        DB::table('student_groups')->insert($data);
    }

    /**
     * Gets attendance details.
     */
    static public function findPresences()
    {
        $presences = DB::select('
            SELECT p.student_id, s.start_time, s.end_time, s.local, s.id, p.is_present
            FROM presences p
            JOIN seances s ON p.seance_id = s.id
            ORDER BY s.start_time, p.student_id
        ');
        return $presences;
    }

    /**
    * Finds all students in the table 'students'
    *
    * @return void
    */
    static public function findAllStudents() {
        $students = DB::select( '
            SELECT id, last_name, first_name
            FROM students
            ORDER BY id ASC
        ' );
        return $students;
    }

    /**
    * Finds all courses in the table 'courses'
    *
    * @return void
    */
    static public function findAllCourses() {
        $students = DB::select( '
            SELECT id, name, teacher_id
            FROM courses
            ORDER BY id ASC
        ' );
        return $students;
    }

    /**
    * Adds or updates a student to a course belonging the course_id and the student_id
    *
    * @param  integer $course_id     The id of the course to add the student to
    * @param  integer $student_id    The id of the student to add to a course
    * @param  boolean $add           The status of the adding
    *
    * @throws QueryException if the query could not be executed
    *
    * @return void
    */
    static public function addAndUpdateStudentToCourse( $course_id, $student_id, $add ) {
        // Looks in the table 'exception_student_list' if the student
        // given in the parameters is already added with the course given in the parameters
        $student = DB::select('
            SELECT course_id, student_id
            FROM exception_student_list
            WHERE course_id = ? AND student_id = ?
            ',
            [$course_id, $student_id]
        );
        if ( empty( $student ) ) {
            // Inserts the student given as parameter in the table 'exception_student_list'
            // with the course givent as parameters
            DB::table( 'exception_student_list' )->updateOrInsert( [
                'course_id' => $course_id,
                'student_id' => $student_id,
            ], ['add' => $add] );
        } else {
            throw new Exception( "L'étudiant a déjà été ajouté à ce cours !" );
        }
    }

    /**
    * Selects a student
    *
    * @param  integer $id  The id of the student to select
    *
    * @return void
    */
    static public function selectStudent( $id ) {
        return DB::table( 'students' )
        ->select( 'id' )
        ->where( 'id', ' = ', $id )
        ->get();
    }

    /**
    * Selects a course
    *
    * @param  integer $id  The id of the course to select
    *
    * @return void
    */
    static public function selectCourse( $id ) {
        return DB::select( 'select id from courses where id = ?', [$id] );
    }

    /**
    * Selects all the elements from the table 'exception_student_list'
    *
    * @return all the elements of the table
    */
    public static function selectAllExceptions() {
        return DB::table( 'exception_student_list' )->get();
    }

    /**
    * Deletes a student from the table 'exception_student_list'
    *
    * @param  integer $course_id   The id of the course to add to the table
    * @param  integer $student     The id of the student to add to the table
    *
    * @return void
    */
    public static function DeleteStudentFromCourse( $course_id, $student_id ) {
        // Looks in the table 'exception_student_list' if the student
        // given in the parameters is already added with the course given in the parameters
        $student = DB::select('
            SELECT course_id, student_id
            FROM exception_student_list
            WHERE course_id = ? AND student_id = ?
            ',
            [$course_id, $student_id]
        );
        if ( !empty( $student ) ) {
            // Deletes a student from the table 'exception_student_list'
            // with the parameters of the function
            DB::delete('
                DELETE
                FROM exception_student_list
                WHERE course_id = ? AND student_id = ?
            ',
            [$course_id, $student_id]
        );
        } else {
            // echo '<script>alert(\'L'étudiant n'a pas encore été ajouté à ce cours !\')</script>';
            throw new Exception( "L'étudiant n'a pas encore été ajouté à ce cours !" );
        }
    }

    /**
     * Inserts into the database presences records.
     */
    static public function insertPresences($presences)
    {
        foreach ($presences as $presence) {
            DB::table('presences')->updateOrInsert(
                ["seance_id" => $presence["seance_id"], "student_id" => $presence["student_id"]],
                ["is_present" => $presence["is_present"]]
            );
        }
    }
}
