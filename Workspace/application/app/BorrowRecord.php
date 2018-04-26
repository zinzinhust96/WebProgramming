<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    protected $fillable = [
        'book_copy_id', 'user_id', 'status', 'card_id'
    ];

    public function createNewBorrowRecord($bookCopyID, $userID)
    {
        $this->create([
            'book_copy_id' => $bookCopyID,
            'user_id' => $userID,
            'status' => 'registered'
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookCopy()
    {
        return $this->belongsTo('App\BookCopy');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function borrowInformation()
    {
        return $this->hasOne('App\BorrowInformation');
    }

    public function getRegisteredBorrowRecord($userID, $bookCopyIds)
    {
        return $this->whereIn('status', ['registered', 'accepted'])
            ->where('user_id', $userID)
            ->whereIn('book_copy_id', $bookCopyIds)
            ->orderBy('created_at', 'desc')->first();
    }

    public function getBorrowRecordByID($borrowRecordID)
    {
        return $this->find($borrowRecordID);
    }

    public function updateBorrowRecordStatus($status)
    {
        $this->setAttribute('status', $status);
        $this->save();
    }

    public function isOverDue()
    {
        if (is_null($this->getAttribute('borrowInformation'))) {
            return false;
        }

        return is_null($this->getAttribute('borrowInformation')->getAttribute('returned_date'))
            && ($this->getAttribute('borrowInformation')->getAttribute('expired_date') > new DateTime());
    }
}