<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class SeancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seances')->insert([
            'id' => 1,
            'course_group' => 1,
            'start_time' => ('2021-12-16 14:45:00'),
            'end_time' => ('2021-12-16 18:00:00'),
            'local' => 404,
        ]);
    }
}