<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class BorrowCard extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $table = 'borrow_cards';

    /**
     * Retrieve the borrow card that have the card number in the database
     * @param $cardNumber
     * @return BorrowCard
     */
    public function getBorrowCardByCardNumber($cardNumber)
    {
        return $this->where('card_number', $cardNumber)->first();
    }

    /**
     * Check the borrowing card belongs to the current user
     * @param $userID
     * @return boolean
     */
    public function validateBorrowCard($userID)
    {
        return $this->getAttribute('user')->getAttribute('id') == $userID;
    }

    /**
     * Check if the borrow card is expired
     * @return boolean
     */
    public function checkExpirationDate()
    {
        return new DateTime($this->getAttribute('expired_date')) > new DateTime();
    }
}
