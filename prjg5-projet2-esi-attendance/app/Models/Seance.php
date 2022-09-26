<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance {

    /**
     * Gets all students who don't attend at a given course.
     */
    static public function getStudentsNotInSeance($seanceId) 
    {
        $students = DB::select("SELECT *
                                    FROM students
                                    WHERE id NOT IN (
                                        SELECT st.id
                                            FROM seances s
                                                JOIN courses_groups cg ON s.course_group = cg.id
                                                JOIN student_groups sg ON cg.group_id = sg.group_name
                                                JOIN students st ON sg.student_id = st.id
                                            WHERE s.id = ? AND st.id NOT IN (SELECT st.id
                                                                                FROM seances s
                                                                                    JOIN courses_groups cg ON s.course_group = cg.id
                                                                                    JOIN exception_student_list esl ON cg.course_id = esl.course_id
                                                                                    JOIN students st ON esl.student_id = st.id
                                                                                WHERE s.id = ? AND esl.state = 0)
                                        UNION
                                        SELECT st.id
                                            FROM seances s
                                                JOIN courses_groups cg ON s.course_group = cg.id
                                                JOIN exception_student_list esl ON cg.course_id = esl.course_id
                                                JOIN students st ON esl.student_id = st.id
                                            WHERE s.id = ? AND esl.state = 1)", [$seanceId, $seanceId, $seanceId]);
        return $students;
    }

    /**
     * Gets presences for a given seance.
     */
    static public function getPresences($seanceId)
    {
        $presences = DB::select("SELECT * FROM presences WHERE seance_id = ?", [$seanceId]);
        return $presences;
    }
    
    public static function getSeances() {
        return DB::select("SELECT s.id, c.name as title, s.start_time as start, s.end_time as end
        FROM seances s
        JOIN courses_groups cg ON s.course_group = cg.id
        JOIN courses c ON cg.course_id = c.id");
    }

}