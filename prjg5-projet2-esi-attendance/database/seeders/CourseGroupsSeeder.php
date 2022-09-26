<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class CourseGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses_groups')->insert([
            "course_id" => 1,
            "group_id"  => "E11"
        ]);
        DB::table('courses_groups')->insert([
            "course_id" => 3,
            "group_id"  => "E12"
        ]);
    }
}
