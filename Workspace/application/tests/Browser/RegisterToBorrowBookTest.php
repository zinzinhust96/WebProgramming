<?php

namespace Tests\Browser;

use App\User;
use App\BookCopy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group registerToBorrowBook
 * Tests the register to borrow book use case
 */
class RegisterToBorrowBookTest extends DuskTestCase
{   
    public function testWrongPasswordConfirmation()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/register-to-borrow-book/create')
                    ->assertSee("List of Books")
                    ->assertSee("Register")
                    ->click('#book-list > div:nth-child(2) > div > table > tbody > tr:nth-child(11) > td:nth-child(6) > input')
                    ->click('#open-register-modal')
                    ->whenAvailable('.modal', function ($modal) {
                        $modal->waitFor('#modal-title')
                                ->assertSee('Register to Borrow Book')
                                ->type('#borrow-card', '0001')
                                ->type('password-confirmation', 'borrower123')
                                ->click('#open-borrow-modal-button');
                    })
                    ->assertSee("The password confirmation not match!");
        });
    }

    public function testBorrowCardNumberNotValid()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/register-to-borrow-book/create')
                    ->assertSee("List of Books")
                    ->assertSee("Register")
                    ->click('#book-list > div:nth-child(2) > div > table > tbody > tr:nth-child(11) > td:nth-child(6) > input')
                    ->click('#open-register-modal')
                    ->whenAvailable('.modal', function ($modal) {
                        $modal->waitFor('#modal-title')
                                ->assertSee('Register to Borrow Book')
                                ->type('#borrow-card', '0123456788242')
                                ->type('password-confirmation', 'borrower')
                                ->click('#open-borrow-modal-button');
                    })
                    ->assertSee("The borrow card number is not valid!");
        });
    }

    public function testInvalidBorrowCard()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/register-to-borrow-book/create')
                    ->assertSee("List of Books")
                    ->assertSee("Register")
                    ->click('#book-list > div:nth-child(2) > div > table > tbody > tr:nth-child(11) > td:nth-child(6) > input')
                    ->click('#open-register-modal')
                    ->whenAvailable('.modal', function ($modal) {
                        $modal->waitFor('#modal-title')
                                ->assertSee('Register to Borrow Book')
                                ->type('#borrow-card', '0003')
                                ->type('password-confirmation', 'borrower')
                                ->click('#open-borrow-modal-button');
                    })
                    ->assertSee("This borrow card is not belong to you!");
        });
    }

    public function testExpiredBorrowCard()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/register-to-borrow-book/create')
                    ->assertSee("List of Books")
                    ->assertSee("Register")
                    ->click('#book-list > div:nth-child(2) > div > table > tbody > tr:nth-child(11) > td:nth-child(6) > input')
                    ->click('#open-register-modal')
                    ->whenAvailable('.modal', function ($modal) {
                        $modal->waitFor('#modal-title')
                                ->assertSee('Register to Borrow Book')
                                ->type('#borrow-card', '0002')
                                ->type('password-confirmation', 'borrower')
                                ->click('#open-borrow-modal-button');
                    })
                    ->assertSee("Your borrow card is expired!");
        });
    }

    public function testRegisterSuccessfully()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/register-to-borrow-book/create')
                    ->assertSee("List of Books")
                    ->assertSee("Register")
                    ->click('#book-list > div:nth-child(2) > div > table > tbody > tr:nth-child(11) > td:nth-child(6) > input')
                    ->click('#open-register-modal')
                    ->whenAvailable('.modal', function ($modal) {
                        $modal->waitFor('#modal-title')
                                ->assertSee('Register to Borrow Book')
                                ->type('#borrow-card', '0001')
                                ->type('password-confirmation', 'borrower')
                                ->click('#open-borrow-modal-button');
                    })
                    ->assertSee("Register successfully!");
        });
    }
    
    function testRegisterToBorrowBookControllerWorks()
    {
        $this->withoutMiddleware();
        $user = User::find(3);
        $response = $this->actingAs($user);        
        $response = $this->call('POST', '/register-to-borrow-book/store', [
            'password-confirmation' => $user->password,
            'borrow-card' => '0123456789',
            'book-ids' => "[\"3\"]"
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }
}
