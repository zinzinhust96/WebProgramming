<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_number',
        'title',
        'publisher',
        'authors',
        'category',
        'isbn',
    ];

    /**
     * Get referenced book's copies
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function copies()
    {
        return $this->hasMany('App\BookCopy');
    }

    /**
     * Update number of copies by counting
     * @return Book
     */
    public function updateNumberOfCopies()
    {
        $this->update([
           'number_of_copies' => $this->getAttribute('copies')
                                    ->count()
        ]);

        return $this;
    }

    /**
     * Get number of available copies
     * @return int
     */
    public function numberOfAvailableCopies()
    {
        return $this->copies()
            ->where('copy_status', 'available')
            ->count();
    }

    /**
     * Get an available copy to borrow
     * @return Model|null|static
     */
    public function getAnAvailableCopy()
    {
        return $this->copies()
            ->where('copy_status', 'available')
            ->first();
    }

    /**
     * Generate book number from book category
     * @param $category
     * @return string
     */
    public function generateBookNumber($category)
    {
        $categoryBookCount = $this->where('category', $category)->count();
        $shortCategory = strtoupper(substr($category, 0, 2));
        return $shortCategory . str_pad($categoryBookCount , 4, "0", STR_PAD_LEFT );
    }

    /**
     * Insert a new book into the database
     * @param $bookNumber
     * @param $title
     * @param $publisher
     * @param $authors
     * @param $bookCategory
     * @param $isbn
     */
    public function createNewBook($bookNumber, $title, $publisher, $authors, $bookCategory, $isbn){
        $this->setAttribute('book_number', $bookNumber)
            ->setAttribute('title', $title)
            ->setAttribute('publisher', $publisher)
            ->setAttribute('authors', $authors)
            ->setAttribute('category', $bookCategory)
            ->setAttribute('isbn', $isbn);
        
        $this->save();
    }

    /**
     * Get book by search title and book_number
     * @param $title
     * @param $number
     * @return mixed
     */
    public function getBookByTitleAndNumber($title, $number)
    {
        return $this->where('title', 'like', '%'.$title.'%')
        ->where('book_number', 'like', '%'.$number.'%')->first();
    }

    /**
     * Get total number of copies
     * @return int
     */
    public function number_of_copies()
    {
        return $this->copies()->count();
    }
}
