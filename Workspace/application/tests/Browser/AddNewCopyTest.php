<?php

namespace Tests\Browser;

use App\BookCopy;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group addNewCopy
 * Tests the add new copy use case
 */
class AddNewCopyTest extends DuskTestCase
{
    public function testAddNewCopyViewDisplayCorrectly()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/book/1/copy/create')
                    ->assertSee("Create New Copy of existing book")
                    ->assertSee("Book Number")
                    ->assertSee("Number of Copies")
                    ->assertInputValue('number_of_copies', '')
                    ->assertSee("Type of copy")
                    ->assertSee("Price")
                    ->assertInputValue('price', '')
                    ->assertValue('> div.container > div > form > div > div > div:nth-child(1) > input', 'Create copies')
                    ->assertSee('Cancel');
        });
    }

    function testAddNewCopyControllerWorks()
    {
        $this->withoutMiddleware();
        
        $user = User::find(1);
        $response = $this->actingAs($user);   

        $copy = new BookCopy();
        $copy->setAttribute('type_of_copy', 'referenced');
        $copy->setAttribute('price', '4400');
        $copy->setAttribute('copy_status', 'referenced');
    
        $response = $this->post('/book/1/copy', [
            'type_of_copy' => $copy->getAttribute('referenced'),
            'price' => $copy->getAttribute('price'),
            'copy_status' => $copy->getAttribute('copy_status'),
        ]);
    
        $response
            ->assertStatus(302);
    }
}
