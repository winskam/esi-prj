<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Session;
use \Illuminate\Support\Facades\DB;

class SessionTest extends TestCase
{
    /**
     *
     * A basic unit test example.
     *
     * @return void
     */
    public function test_importICS()
    {
        Session::importICS("public/horaire.ics");

        $this->assertTrue(DB::table('courses')->count() >= 7);
        $this->assertTrue(DB::table('teachers')->count() >= 1);
        $this->assertTrue(DB::table('groups')->count() >= 13);
        $this->assertTrue(DB::table('courses_groups')->count() >= 187);
        $this->assertTrue(DB::table('seances')->count() >= 187);
    }
}
