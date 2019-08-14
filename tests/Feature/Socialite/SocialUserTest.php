<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class SocialUserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function google_social_login_1(){
        $this->withoutExceptionHandling();
        $response=$this->get("login/github");
        $response->assertStatus(302);
        //$this->assertCount(1, User::all());
    }




    
}