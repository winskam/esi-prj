<?php


namespace App\Models;

use Illuminate\Support\Facades\DB;

use ICal\ICal;

class Session
{


    public static function importICS(String $ics)
    {
        $ical = new iCal($ics);

        $teacherInfo = $ical->cal["VCALENDAR"]["X-WR-CALNAME"];
        $teacherArray = explode(" - ", $teacherInfo);
        $acro = substr($teacherArray[1], 0, 3);
        $nameArray = explode(" ", substr($teacherArray[1], 4, strlen($teacherArray[1])));
        $lastName = "";
        $firstName = "";
        foreach ($nameArray as $n) {
            if (ctype_upper($n)) {
                $lastName = $lastName . $n . " ";
            } else {
                $firstName = $firstName . $n . " ";
            }
        }
        $lastName = substr($lastName, 0, -1);
        $firstName = substr($firstName, 0, -1);
        if (sizeof(DB::table('teachers')
            ->where('acronym', $acro)->get()->toArray()) == 0) {
            DB::insert('insert into teachers (acronym,first_name,last_name) values (?,?,?)', [$acro, $firstName, $lastName]);
        }
        $idDB = 1;
        foreach ($ical->cal["VEVENT"] as $event) {
            $course = $event["DESCRIPTION_array"][1];
            $split = explode("\\n", $course);
            $array = array();
            foreach ($split as $p) {
                array_push($array, explode(" : ", $p));
            }

            $name = $array[0][1];
            $classroom = $array[3][1];
            $groups = explode("\,", $array[2][1]);
            $start = date("d-m-Y H:i:s", strtotime($event['DTSTART']));
            $end = date("d-m-Y H:i:s", strtotime($event['DTEND']));

            $course_exist = DB::table('courses')
                ->where('ue', $name)->where('teacher_id', $acro)->get()->toArray();

            $id_course = 0;

            //add if possible
            if (sizeof($course_exist) == 0) {
                $id_course = DB::table('courses')->insertGetId(
                    array('ue' => $name, 'name' => 'To be filled by teacher', 'teacher_id' => $acro)
                );
            } else {
                $id_course = $course_exist[0]->id;
            }

            
            foreach ($groups as $group) {
                if (sizeof(DB::table('groups')
                    ->where('name', $group)->get()->toArray()) == 0) {

                    DB::insert('insert into groups  values (?)', [$group]);
                }
                $id_group = DB::table('courses_groups')->insertGetId(
                    array('course_id' => $id_course, 'group_id' => $group)
                );

                $id = DB::table('seances')->insertGetId(
                    array('course_group' => $id_group, 'start_time' => $start, 'end_time' => $end, 'local' => $classroom)
                );
            }
        }

    }
}
