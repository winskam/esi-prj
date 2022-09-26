<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use App\Queries;
use SimpleXLSXGen;

class StatsExportController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function interface()
    {
        $file_name = "test.csv";
        $presences = Queries::findPresences();

        return view("stats_export");
    }

    function export(Request $request)
    {
        switch($request->extension) {
            case "csv":
                return self::export_csv($request);
            case "xlsx":
                return self::export_xlsx($request);
        }
    }

    function export_csv(Request $request)
    {
        $fileName = $file_name = $request->name.".".$request->extension;
        $presences = Queries::findPresences();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Student', 'Begin_time', 'Ending_time', 'Local', 'Course', 'Presence');

        $callback = function() use ($presences, $columns)
        {
            $file = fopen("php://output", 'w');
            fputcsv($file, $columns);
            foreach($presences as $student){
                $student_details = array();
                foreach($student as $student_detail => $student_detail_value){
                    array_push($student_details, (string) $student_detail_value);
                }
                fputcsv($file, $student_details);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    function export_xlsx(Request $request)
    {
        $filename = $request->name.".".$request->extension;
        $presences = Queries::findPresences();

        $headers = array(
            "Content-Disposition" => "attachment; filename=$filename"
        );

        $columns = ['Student', 'Begin_time', 'Ending_time', 'Local', 'Course', 'Presence'];

        $stats = [$columns];
        foreach($presences as $student){
            $student_details = array();
            foreach($student as $student_detail => $student_detail_value){
                array_push($student_details, (string) $student_detail_value);
            }
            array_push($stats, $student_details);
        }

        $xlsx = SimpleXLSXGen::fromArray($stats);
        $xlsx->downloadAs($filename);
    }

}
