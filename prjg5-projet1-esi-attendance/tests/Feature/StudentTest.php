<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\Student;
use App\Http\Controllers\StudentsCtrl;


class StudentTest extends TestCase
{
    /**
     * A test of students.
     *
     * @return void
     */
    public function test_api_students_response()
    {
        $response = $this->get('/api/students');

        $response->assertStatus(200);
    }

    /**
     * A test of students.
     *
     * @return void
     */
    public function test_api_students()
    {
        $response = $this->json('GET', '/api/students');
        
        
        $response->assertJsonFragment([
            "id" => 28,
            "last_name" => "Clapison",
            "first_name" => "Keelia"]);
    }

    public function test_insert()
    {

        $student = new Student(55315,"Tison","Oscar");

        Student::add($student);
       
        $this->assertDatabaseHas('Student', [
            'id' => 55315,
            'last_name' => "Tison",
            'first_name' => "Oscar"
        ]);
    }


    public function test_delete()
    {

        $response = $this->call('DELETE', '/students/20');
        $this->assertEquals(204, $response->getStatusCode());
    }

}
