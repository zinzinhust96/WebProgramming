<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookCopy extends Model
{
    protected $table = 'book_copies';

    protected $fillable = [
        'copy_number', 'book_id', 'type_of_copy',
        'price', 'copy_status', 'integrity_status'
    ];

    /**
     * Get referenced book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(){
        return $this->belongsTo('App\Book');
    }

    /**
     * Create new copy for a book and insert it to the database
     *
     * @param Book $book the book we want to create copy for
     * @param Request $request
     */
    public function createNewCopyForBook(Book $book, Request $request)
    {
        $copyNumber = self::generateCopyNumber($book);

        $this->setAttribute('type_of_copy', $request->input('type_of_copy'))
            ->setAttribute('price', $request->input('price'))
            ->setAttribute('copy_number', $copyNumber)
            ->setAttribute('book_id', $book->getAttribute('id'));
            

        if($request->input('type_of_copy') == 'referenced'){
            $this->setAttribute('copy_status', 'referenced');
        }else {
            $this->setAttribute('copy_status', 'available');
        }

        $this->save();
    }

    private function generateCopyNumber(Book $book)
    {
        $numberOfCopies = $this->where('book_id', $book->getAttribute('id'))->count();
        $sequenceNumber = $numberOfCopies + 1;
        return $book->getAttribute('book_number') . str_pad($sequenceNumber , 3, "0", STR_PAD_LEFT );
    }

    public function updateBookCopyStatus($copyStatus, $integrityStatus = null)
    {
        $this->setAttribute('integrity_status', $integrityStatus)
            ->setAttribute('copy_status', $copyStatus);
        $this->save();
    }
}
