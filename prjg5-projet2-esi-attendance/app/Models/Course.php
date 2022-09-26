<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Course
{
    /**
     * Gets the course associated to a given seance.
     */
    public static function fromSeance($seanceId) 
    {
        return DB::select("SELECT c.*
                            FROM seances s
                                JOIN courses_groups cg ON s.course_group = cg.id
                                JOIN courses c ON cg.course_id = c.id
                            WHERE s.id = ?", [$seanceId]);
    }
}
