<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class StudentGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = DB::table('students')->pluck('id');
        $faker = Faker::create();
        foreach($students as $student) { 
            DB::table('student_groups')->insert([
                'student_id' => $student,
                'group_name' => "E11",
            ]);
        }
    }
}