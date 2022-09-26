<?php

namespace Tests\Feature;

use Tests\TestCase;

class studentsManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_manage()
    {
        $response = $this->get('/students_management');

        $response->assertStatus(200);
    }

}
