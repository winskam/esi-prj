<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    /**
     * Method to count all the students in the table 'students'
     */
    public static function countAllStudents()
    {
        return DB::table( 'students' )
        ->get()
        ->count();
    }

    /**
     * Method to add a student and a student_group in the DB.
     */
    public static function add($id, $last, $first, $group) {
        if($id>0){
            DB::insert('insert into students (id, last_name, first_name) values (?, ?, ?)', [$id, $last, $first]);
            DB::insert('insert into student_groups (student_id, group_name) values (?, ?)', [$id, $group]);
        }
    }

    /**
     * Finds all students in the table "students"
     *
     * @return ResultSet
     */
    public static function findAllStudents()
    {
        $students = DB::select('
            SELECT id, last_name, first_name
            FROM students
            ORDER BY id ASC
        ');
        return $students;
    }

    /**
    * Selects a student's id belonging its id
    *
    * @param  integer $id  The id of the student to select
    *
    * @return void
    */
    public static function selectStudent( $id ) {
        return DB::table( 'students' )
        ->select( 'id' )
        ->where( 'id', '=', $id )
        ->get()
        ->toArray();
    }

    /**
     * Delete a student from the database
     *
     * @return void
     */
    public static function deleteStudent($id)
    {
        DB::table('students')->where('id','=',$id)->delete();
    }
}
