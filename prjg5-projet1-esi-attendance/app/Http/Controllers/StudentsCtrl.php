<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;


class StudentsCtrl extends Controller
{

    function getStudents()
    {
        $result = Student::get();
        return response()->json($result);
    }

    function students()
    {
        $students = Student::get();
        return view('index', compact('students'));
    }

    function delete($id) {
        Student::delete($id);
        $students = Student::get();
        return view('index', compact('students'));
    }

    function insert_student(Request $request) {
        $student = new Student($request->id,$request->lastname,$request->firstname);
        Student::add($student);
        $students = Student::get();
        return view('index', compact('students'));
        //return response(null, 201);
    }

}
