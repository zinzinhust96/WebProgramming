<?php

namespace Tests\Browser;

use App\Book;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group addNewBook
 * Tests the add new book use case
 */
class AddNewBookTest extends DuskTestCase
{
    public function testAddNewBookViewDisplayCorrectly()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/book/create')
                    ->assertSee("Create New Book")
                    ->assertSee("Title")
                    ->assertInputValue('title', '')
                    ->assertSee("Publisher")
                    ->assertInputValue('publisher', '')
                    ->assertSee("Authors")
                    ->assertInputValue('authors', '')
                    ->assertSee("ISBN")
                    ->assertInputValue('isbn', '')
                    ->assertValue('> div > div > form > div > div:nth-child(1) > input', 'Create Book')
                    ->assertSee('Cancel');
        });
    }

    function testAddNewBookControllerWorks()
    {
        $this->withoutMiddleware();

        $user = User::find(1);
        $response = $this->actingAs($user);  

        $book = new Book();
        $book->setAttribute('title', 'Mock Up Book');
        $book->setAttribute('publisher', 'Mock Up Publisher');
        $book->setAttribute('authors', 'Mock Up Authors');
        $book->setAttribute('isbn', 'Mock Up ISBN');
    
        $mockUpBook = [
            'title' => 'Mock Up Book',
            'publisher' => 'Mock Up Publisher',
            'authors' => 'Mock Up Authors',
            'isbn' => 'Mock Up ISBN',
        ];
    
        $response = $this->post('/book', [
            'title' => $book->getAttribute('title'),
            'publisher' => $book->getAttribute('publisher'),
            'authors' => $book->getAttribute('authors'),
            'isbn' => $book->getAttribute('isbn'),
        ]);
    
        $response
            ->assertStatus(302);
    }
}
