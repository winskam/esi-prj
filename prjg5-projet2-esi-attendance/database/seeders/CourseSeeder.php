<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = DB::table('teachers')->pluck('acronym');
        $faker = Faker::create();
        DB::table('courses')->insert([
            'id' => 1,
            'ue' => 'PRJG5',
            'name' => 'Gestion de projet',
            'teacher_id' => $faker->randomElement($teachers),
        ]);
        DB::table('courses')->insert([
            'id' => 3,
            'ue' => 'WEBG5',
            'name' => 'Développement web V',
            'teacher_id' =>$faker->randomElement($teachers),
        ]);
    }
}
