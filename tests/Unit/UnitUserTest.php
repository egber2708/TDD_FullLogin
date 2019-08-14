<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitUserTest extends TestCase
{

    use RefreshDatabase;
    /** @test */
    public function user_create_test_u1()
    {
        User::create([
                "name" => "Egber Insignares",
                "email" => "egber27@hotmail.com",
                "password" => "rniweoipghwergewnj234ifod4",
        ]);

        $this->assertCount(1, User::all());
    }
}
