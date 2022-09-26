<?php

namespace Tests\Unit;

use Tests\TestCase;
use Exception;
use \Illuminate\Support\Facades\DB;

use App\GroupsCSV;
use App\Queries;

class CSVTest extends TestCase
{
    /**
     * Insert a valid CSV file in order to refresh the group assignments for each student.
     *
     * @todo Edit the seeders in order to fill the database with static data in order to avoid primary key constraint error.
     */
    public function test_insert_valid_file()
    {
        $expectedCount = 30; //number of lines in the test file

        $csv_data = GroupsCSV::csvToArray("public/testAffectations.csv");
        Queries::insertGroupsForStudents($csv_data);
        $count = DB::table('student_groups')->count();

        $this->assertEquals($expectedCount, $count);
    }

    /**
     * Insert an invalid CSV file, which shoulds raise an error.
     */
    public function test_insert_invalid_file()
    {
        $errorsCatched = false;

        try {
            $csv_data = GroupsCSV::csvToArray("public/testAffectationsInvalides.docx");
        } catch(Exception $ex) {
            $errorsCatched = true;
        }

        $this->assertTrue($errorsCatched);
    }
}
