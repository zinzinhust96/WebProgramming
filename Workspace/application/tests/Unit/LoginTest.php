<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function testLoginPageAccessible()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    // public function testLoginController()
    // {
    //     $response = $this->withHeaders([
    //         'X-Header' => 'Value',
    //     ])->json('POST', '/login', ['email' => 'zinzinhust96@gmail.com',
    //                                 'password' => '20143012']);

    //     $response
    //         ->assertStatus(200)
    //         ->assertRedirect('/home')
    //         ->assertJson([
    //             'created' => true,
    //         ]);
    // }

    public function testUserValidLogin(){
        Session::start();
        $response = $this->call('POST', '/login', [
            'email' => 'zinzinhust96@gmail.com',
            'password' => '20143012',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
