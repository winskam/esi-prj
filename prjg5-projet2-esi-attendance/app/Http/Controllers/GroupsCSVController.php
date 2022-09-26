<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupsCSV;
use App\Queries;
use Exception;

class GroupsCSVController extends Controller
{

    public function interface(){
        return view('students_groups', ["error" => false, "success" => false]);
    }

    public function importCsv(Request $request){
        try {
            $csv_file = $request->file('studentsGroupsCSV');
            $csv_data = GroupsCSV::csvToArray($csv_file);
        } catch (Exception $exception) {
            return view('students_groups', ["error" => true, "success" => false]);
        }
        try {
            try {
                Queries::insertGroupsForStudents($csv_data);
            } catch (\TypeError $e) {
                return redirect()->back()->withErrors( "Le fichier n'est pas valide !" );
            }
        } catch (Exception $exception) {
            return view('students_groups', ["error" => true, "success" => false]);
        }
        return view('students_groups', ["error" => false, "success" => true]);
    }

}
