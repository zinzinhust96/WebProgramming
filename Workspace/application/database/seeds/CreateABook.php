<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CreateABook extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'book_number' => 'TE0000',
            'title' => 'College Physics 9th Edition',
            'publisher' => 'CENGAGE Learning',
            'authors' => 'Raymond A. Serway, Chris Vuille',
            'category' => 'Textbook',
            'isbn' => '0123456777',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'TE0001',
            'title' => 'Physics I',
            'publisher' => 'HUST',
            'authors' => 'Le Tuan',
            'category' => 'Textbook',
            'isbn' => '0123456776',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'TE0002',
            'title' => 'Data structure and algorithm',
            'publisher' => 'HUST',
            'authors' => 'Pham Quang Dung',
            'category' => 'Textbook',
            'isbn' => '0123456775',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'TE0003',
            'title' => 'Software development',
            'publisher' => 'HUST',
            'authors' => 'Nguyen Thi Thu Trang',
            'category' => 'Textbook',
            'isbn' => '0123456774',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'HI0000',
            'title' => 'Guns, Germs, and Steel: The Fates of Human Societies',
            'publisher' => 'W.W. Norton & Company',
            'authors' => 'Jared Diamond',
            'category' => 'History',
            'isbn' => '0123456767',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'HI0001',
            'title' => 'A Short History of Nearly Everything',
            'publisher' => 'Broadway Books',
            'authors' => 'Bill Bryson',
            'category' => 'History',
            'isbn' => '0123456766',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'HI0002',
            'title' => 'The Guns of August',
            'publisher' => 'Ballantine Books',
            'authors' => 'Barbara W. Tuchman, Robert K. Massie (Foreword)',
            'category' => 'History',
            'isbn' => '0123456765',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'HI0003',
            'title' => 'Spiderman: Homecoming',
            'publisher' => 'Anchor',
            'authors' => 'Tom Holland',
            'category' => 'History',
            'isbn' => '0123456764',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'DI0000',
            'title' => 'The Compact Edition of the Oxford English Dictionary',
            'publisher' => 'Clarendon/Oxford University Press',
            'authors' => 'Herbert Coleridge (editor), Frederick J. Furnivall (editor), James Murray (editor), Charles Talbut Onions (editor)',
            'category' => 'Dictionary',
            'isbn' => '0123456757',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'DI0001',
            'title' => 'Merriam-Webster\'s Collegiate Dictionary',
            'publisher' => 'Merriam-Webster, Inc',
            'authors' => 'Anonymous',
            'category' => 'Dictionary',
            'isbn' => '0123456756',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'DI0002',
            'title' => 'Cambridge Advanced Learner\'s Dictionary',
            'publisher' => 'Cambridge University Press',
            'authors' => 'Elizabeth Walter',
            'category' => 'Dictionary',
            'isbn' => '0123456755',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'DI0003',
            'title' => 'The Official Scrabble Players Dictionary',
            'publisher' => 'Merriam-Webster',
            'authors' => 'Anonymous',
            'category' => 'Dictionary',
            'isbn' => '0123456754',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'PO0000',
            'title' => 'Leaves of Grass',
            'publisher' => 'Simon & Schuster',
            'authors' => 'Walt Whitman',
            'category' => 'Poetry',
            'isbn' => '0123456747',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'PO0001',
            'title' => 'Shakespeare\'s Sonnets',
            'publisher' => 'Bloomsbury Academic',
            'authors' => 'William Shakespeare, Katherine Duncan-Jones (Editor)',
            'category' => 'Poetry',
            'isbn' => '0123456746',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'PO0002',
            'title' => 'The Waste Land and Other Poems',
            'publisher' => 'Harcourt Brace Jovanovich',
            'authors' => 'T.S. Eliot',
            'category' => 'Poetry',
            'isbn' => '0123456745',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'PO0003',
            'title' => 'Songs of Innocence and of Experience',
            'publisher' => 'Digireads.com',
            'authors' => 'William Blake',
            'category' => 'Poetry',
            'isbn' => '0123456744',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'BI0000',
            'title' => 'Steve Jobs',
            'publisher' => 'Simon Schuster',
            'authors' => 'Walter Isaacson',
            'category' => 'Biography',
            'isbn' => '0123456737',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'BI0001',
            'title' => 'Einstein: His Life and Universe',
            'publisher' => 'Simon Schuster',
            'authors' => 'Walter Isaacson',
            'category' => 'Biography',
            'isbn' => '0123456736',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'BI0002',
            'title' => 'Into the Wild',
            'publisher' => 'Anchor Books',
            'authors' => 'Jon Krakauer',
            'category' => 'Biography',
            'isbn' => '0123456735',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('books')->insert([
            'book_number' => 'BI0003',
            'title' => 'Team of Rivals: The Political Genius of Abraham Lincoln',
            'publisher' => 'Simon Schuster',
            'authors' => 'Doris Kearns Goodwin',
            'category' => 'Biography',
            'isbn' => '0123456734',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
