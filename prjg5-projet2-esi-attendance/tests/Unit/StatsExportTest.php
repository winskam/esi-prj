<?php

namespace Tests\Unit;

use Tests\TestCase;
use Exception;
use \Illuminate\Support\Facades\DB;

use App\Queries;

class StatsExportTest extends TestCase
{
    /**
     * Tries to get presences from the database.
     */
    public function test_get_presences()
    {
        $errorsCatched = false;

        try {
            $presences = Queries::findPresences();
        } catch(Exception $ex) {
            $errorsCatched = true;
        }

        $this->assertFalse($errorsCatched);
    }
}
