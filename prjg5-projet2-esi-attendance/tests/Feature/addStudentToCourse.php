<?php

namespace Tests\Feature;

use Tests\TestCase;

class addStudentToCourse extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_seance()
    {
        $response = $this->get('/horaires/1');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_seance()
    {
        $response = $this->post('/horaires/1');

        $response->assertSuccessful();
    }

}
