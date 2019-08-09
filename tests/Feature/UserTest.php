<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function create_user_web_by_manual_register_1()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "egber27@hotmail.com",
            "password" => "rniweoipghwergewnj234ifod4",
        ]);
        $response->assertStatus(200);
        $this->assertCount(1, User::all());
    }

      /** @test */
    public function incompleate_user_web_by_manual_register_2()
    {
        // Creo un registro.
        $response = $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "egber27@hotmail.com",
            "password" => "qwerty1234",
        ]);

        // Ingreso uno con clave menos de 8 digitos 
        $response1 = $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "egber27@hotmail.com",
            "password" => "qwer",
        ]);

        // Ingreso uno sin nombre 
        $response2 = $this->post('web/login', [
            "name" => "",
            "email" => "egber27@hotmail.com",
            "password" => "rniwfsdnfknsdfli",
        ]);
        // Ingreso uno sin clave 
        $response3 = $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "",
            "password" => "rniwfsdnfknsdfli",
        ]);
        // ingreso un usuario repetido 
        $response4 = $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "egber27@hotmail.com",
            "password" => "qwerty123sd4",
        ]);

        // solo debe crear un solo archivo
        $this->assertCount(1, User::all()); 
        $response->assertStatus(200);

        // todas las respuestas de estatus fueron 302.     
        $response1->assertStatus(302);
        $response2->assertStatus(302);
        $response3->assertStatus(302);
        $response4->assertStatus(302); 
    }




}
