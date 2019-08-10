<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;

class WebUserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function create_user_web_by_manual_register_1()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "egber27@hotmail.com",
            "password" =>  bcrypt($password = 'i-love-laravel'),
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


      /** @test */
    public function web_manual_login_3()
    {
        //
        
        $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "egber27@hotmail.com",
            "password" =>  bcrypt($password = 'i-love-laravel'),
        ]);
       
        $response = $this->post('/login', [
            "email" => "egber27@hotmail.com",
            "password" => $password,
        ]);

        $response->assertRedirect('home');
        $this->assertTrue(Auth::check()); 
        $this->assertEquals("egber27@hotmail.com", Auth::user()->email);
    } 
    

     /** @test */
    public function update_web_user_information_4()
    {
      // $this->withoutExceptionHandling();
 
      $this->post('web/login', [
            "name" => "Egber Insignares",
            "email" => "egber27@hotmail.com",
            "password" =>  bcrypt($password = 'i-love-laravel'),
        ]);
       
        $this->post('/login', [
            "email" => "egber27@hotmail.com",
            "password" => $password,
        ]);
   
        $user = Auth::user();

        $response = $this->patch('web/login/'.Auth::id(), [
            "name" =>  "Jorge Cifuentes",
            "email" => "egber28@hotmail.com",
            "password" => "prueba satisfactoria",
        ]);
       
        $user =  $user->fresh(); // Actualiza los valores despues de un update

        $response->assertStatus(200);
        $this->assertEquals("egber28@hotmail.com", $user->email);
        $this->assertEquals("Jorge Cifuentes", $user->name);

    }

    // Forget PassWord And Email Notification 
}
