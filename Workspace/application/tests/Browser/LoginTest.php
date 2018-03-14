<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group login
 * Tests the log in use case
 */
class LoginTest extends DuskTestCase
{
    public function testLoginPageAccessible()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    
    public function testLoginPageDisplayCorrectly()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->assertSee("Login")
                    ->assertSee("E-Mail Address")
                    ->type('email', 'test@gmail.com')             
                    ->assertSee("Password")
                    ->type('password', 'test')
                    ->press('Login');
        });
    }

    public function testInvalidUserLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'invalid-email@gmail.com')
                    ->type('password', 'invalid-password')
                    ->press('Login')
                    ->assertPathIs('/login')
                    ->assertSee('These credentials do not match our records.');
        });
    }

    public function testValidUserLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'borrower@gmail.com')
                    ->type('password', 'borrower')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }

    function testLoginController()
    {       
        Session::start();
        $response = $this->call('POST', '/login', [
            'email' => 'borrower@gmail.com',
            'password' => 'borrower',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
