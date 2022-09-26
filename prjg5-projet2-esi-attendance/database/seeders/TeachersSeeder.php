<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'acronym' => Str::random(10),
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
        ]);
        DB::table('teachers')->insert([
            'acronym' => Str::random(10),
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),    
        ]);

    }
}
