<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group lentBook
 * Tests the register to borrow book use case
 */
class LentBookTest extends DuskTestCase
{
    public function testInvalidUsername()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/borrow-book/create')
                    ->assertSee("Register Information")
                    ->assertSee("Check register")
                    ->type('#user_name', 'invalid-username')
                    ->click('#check-register-btn')
                    ->waitForText("Invalid User name!");
        });
    }

    public function testBookNotFound()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/borrow-book/create')
                    ->assertSee("Register Information")
                    ->assertSee("Check register")
                    ->type('#user_name', 'Borrower')
                    ->type('#book_title', 'Invalid book')
                    ->type('#book_number', 'TE0001')
                    ->click('#check-register-btn')
                    ->waitForText("No book match with title and book number!");
        });
    }

    public function testNoBorrowRecordFound()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/borrow-book/create')
                    ->assertSee("Register Information")
                    ->assertSee("Check register")
                    ->type('#user_name', 'Borrower')
                    ->type('#book_title', 'A Short History of Nearly Everything')
                    ->type('#book_number', 'HI0001')
                    ->click('#check-register-btn')
                    ->waitForText("No record match!");
        });
    }

    public function testBorrowRecordFoundAndLentBookSuccessfully()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/borrow-book/create')
                    ->assertSee("Register Information")
                    ->assertSee("Check register")
                    ->type('#user_name', 'Borrower')
                    ->type('#book_title', 'Rubicon: The Last Years of the Roman Republic')
                    ->type('#book_number', 'HI0003')
                    ->click('#check-register-btn')
                    ->pause(1000)
                    ->type('#status_before', 'brand new')
                    ->type('#borrow_fee', '10000')
                    ->type('#pre_paid', '6000')
                    ->click('> div > div > div:nth-child(2) > div > div.panel-body > form > div:nth-child(8) > input')
                    ->waitForText("Lent book successfully!");
        });
    }
}
