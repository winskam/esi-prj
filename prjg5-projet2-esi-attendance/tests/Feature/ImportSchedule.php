<?php

namespace Tests\Feature;

use Tests\TestCase;

class ImportSchedule extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_import_page()
    {
        $response = $this->get('/import');

        $response->assertStatus(200);
    }

    public function test_post_import_page()
    {
        $response = $this->post('/import');

        $response->assertSuccessful();
    }
}
