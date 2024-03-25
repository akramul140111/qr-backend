<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    /** @test  */
    public function test_auth_login(): void
    {
        $response  = $this->call('POST', '/api/login',[
            'email'     => 'admin@gmail.com',
            'password'  => '12345678@a'
        ]);

        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertTrue(true);
    }

    /** @test  */
    public function test_auth_signup():void
    {
        $response = $this->call("POST","/api/signup", [
            "name"                  => "Mr. Tester",
            'email'                 => "newtesting@gmail.com",
            "password"              => "testing1234@",
            "password_confirmation" => "testing1234@",
            "role"                  => "2"
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function test_auth_checking():void
    {
        $token = $this->test_auth_login();

//        $response = $this->withHeaders([
//            'Content-Type: application/json',
//            'Accept: application/json',
//            'Authorization: Bearer '. $token
//        ])->get('/api/user');

        $response = $this->call("GET","/api/user",[
            "header" => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer '. $token
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

}
