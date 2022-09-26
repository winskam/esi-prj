<?php

namespace App\Http\Controllers;

use App\Queries;
use App\Models\AddStudentToCourseModel;
use App\Models\Course;
use App\Models\StudentModel;
use App\Models\Student;
use App\Models\PresenceFormatter;
use App\Models\Group;
use App\Models\Seance;
use Illuminate\Http\Request;

use Throwable;
use Exception;


class StudentsCtrl extends Controller
{
    function getStudents($seance_id)
    {
        $result = Queries::studentsForSeance($seance_id);
        return response()->json($result);
    }

    /**
     * Handles both taking presence AND adding student to course exceptions.
     */
    function students($seance_id)
    {
        // Students for seance = students for the course related to the seance
        $studentsInCourse = Queries::studentsForSeance($seance_id);
        $presences = [];
        foreach(Seance::getPresences($seance_id) as $presence) {
            $presences[$presence->student_id] = $presence->is_present;
        }
        //return var_dump($presences);
        $studentsNotInCourse = Seance::getStudentsNotInSeance($seance_id);
        return view('presenceException', ['seance_id' => $seance_id,
            'students' => $studentsInCourse,
            'studentsOut' => $studentsNotInCourse,
            'presences' => $presences]);
    }

    /**
     * Add a student to the exception list of a given course.
     */
    public function addException(Request $request, $seance_id)
    {
        $courseId = intval(Course::fromSeance($request->seance_id)[0]->id);
        $studentId = $request->student_id;
        AddStudentToCourseModel::addAndUpdateStudentToCourse($courseId, $studentId, true);
        return self::students($seance_id);
    }

    public function deleteException($seance_id, $student_id)
    {
        $courseId = intval(Course::fromSeance($seance_id)[0]->id);
        $studentId = $student_id;
        try {
            StudentModel::deleteStudentFromCourse($courseId, $studentId);
        } catch (\Exception $exception) {
            echo $exception->getmessage();
        }
        return self::students($seance_id);
    }

    /**
     * Saves presences.
     */
    function save_presences(Request $request, $seance_id)
    {
        $checkboxes = $request->checklist;
        $present_student_ids = $checkboxes != NULL ? array_keys( $checkboxes ) : array();
        try {
            $presences = PresenceFormatter::savePresences($present_student_ids, $seance_id);
            Queries::insertPresences($presences);
        } catch (Exception $ex) {
            return view('presence_validation', ["success" => false]);
        }
        return view( 'presence_validation', ['success' => true] );
    }

    /**
     * Displays interface in order to add a student to database.
     */
    function getIndex()
    {
        return view('addStudent');
    }

    /**
     * Adds a student to the database.
     */
    function add( Request $request ) {
        try {
            if ( isset( $request->id )
            && isset( $request->last_name )
            && isset( $request->first_name ) ) {
                if ( $request->id > 10000 && $request->id < 100000 ) {
                    if ( empty( Student::selectStudent( $request->id ) ) ) {
                        $id = $request->id;
                        $last_name = $request->last_name;
                        $first_name = $request->first_name;
                        $group = $request->group;
                        Student::add( $id, $last_name, $first_name, $group );
                        return redirect()->back()->withSuccess( 'Ajouté(e) !' );
                    } else {
                        return redirect()->back()->withErrors( "Impossible d'ajouter un étudiant dont le matricule a déjà été attribué à un autre étudiant !" );
                    }
                } else {
                    return redirect()->back()->withErrors( "Pour l'ajout, le matricule de l'étudiant doit être compris entre 10000 et 100000 !" );
                }
            } else {
                return redirect()->back()->withErrors( "Pour l'ajout, veuillez remplir chaque champ pour l'ajout !" );
            }
        } catch (Throwable $e) {
            return redirect()->back()->withErrors( "L'étudiant(e) n'a malheureusement pas pu être ajouté(e) !" );
        }
    }


    /**
     * Displays interface in order to delete a student from the database.
     */
    function getAll()
    {
        $students = Student::findAllStudents();
        $groups = Group::findAllGroups();
        return view('students_management', ['students' => $students, 'groups' => $groups]);
    }

    /**
     * Deletes a student from the database.
     */
    function delete($student_id)
    {
        try {
            Student::deleteStudent($student_id);
            return redirect()->back()->withSuccess('Etudiant supprimé!');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors("Erreur, l'étudiant(e) n'a malheureusement pas pu être ajouté(e)!");
        }
    }

}
