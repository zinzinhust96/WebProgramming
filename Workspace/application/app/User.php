<?php

namespace App;

use DateTime;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'full_name', 'gender', 'contact', 'is_student', 'student_id', 'expired_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get number of borrowed copies by the user
     * @return integer
     */
    public function getNumberOfBorrowedCopies(){
        return (new BorrowRecord())->where('user_id', $this->getAttribute('id'))
            ->whereIn('status', ['registered', 'accepted', 'lent'])->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function borrowCards()
    {
        return $this->hasMany('App\BorrowCard');
    }

    /**
     * Get active borrow card
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getActiveBorrowCard()
    {
        return $this->borrowCards()->where('expired_date', '>', new DateTime())
            ->first();
    }

    /**
     * Find user by user name
     * @param string $username
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return $this->where('name', $username)->first();
    }

    public function getUserByUserID($userID)
    {
        return $this->where('id', $userID)->first();
    }

    /**
     * Get active card number
     * @return mixed|null
     */
    public function getBorrowCardNumber()
    {
        if (is_null($this->getActiveBorrowCard())) {
            return null;
        }

        return $this->getActiveBorrowCard()->getAttribute('card_number');
    }

    public function borrowRecords()
    {
        return $this->hasMany('App\BorrowRecord');
    }

    public function hasOverDueBorrow()
    {
        foreach ($this->getAttribute('borrowRecords') as $record) {
            if ($record->isOverDue()) {
                return true;
            }
        }

        return false;
    }
}
