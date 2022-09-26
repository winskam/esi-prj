<?php

namespace App\Models;

use Exception;

use App\Queries;

class PresenceFormatter {

    public static function savePresences($studentsIds, $seanceId) {
        $allStudents = Queries::studentsForSeance($seanceId);
        $presences = [];
        foreach($allStudents as $student) {
            $isPresent = in_array(intval($student->id), $studentsIds); 
            array_push($presences, [
                "seance_id" => $seanceId,
                "student_id" => intval($student->id),
                "is_present" => $isPresent
            ]);
        }
        return $presences;
    }

}