<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Models\FileModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TeachersSeeder::class,
            StudentsSeeder::class,
            CourseSeeder::class,
            GroupsSeeder::class,
            CourseGroupsSeeder::class,
            SeancesSeeder::class,
            StudentGroupsSeeder::class,
        ]);
    }
}
