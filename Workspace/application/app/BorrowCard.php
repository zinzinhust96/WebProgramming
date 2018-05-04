<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function createNewBorrowCard($userID){
        $this->setAttribute('card_number', self::generateBorrowCardNumber())
            ->setAttribute('user_id', $userID)
            ->setAttribute('activation_code', self::generateRandomActivationCode())
            ->setAttribute('expired_date', Carbon::now()->addYears(2))
            ->setAttribute('is_activated', false);
        
        $this->save();
    }

    private function generateBorrowCardNumber() {
        $noOfBorrowCard = $this->count();
        $sequenceNumber = $noOfBorrowCard + 1;
        return str_pad($sequenceNumber , 4, "0", STR_PAD_LEFT );
    }

    private function generateRandomActivationCode($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function isActivated()
    {
        return $this->getAttribute('is_activated');
    }
}
