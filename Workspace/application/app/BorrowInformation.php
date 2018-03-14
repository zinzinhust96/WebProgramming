<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class BorrowInformation extends Model
{
    protected $fillable = [
        'borrow_record_id', 'borrow_card_id', 'status_before',
        'lent_date', 'expired_date', 'return_date', 'borrow_fee',
        'pre_paid', 'compensation', 'total_paid'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrowRecord()
    {
        return $this->belongsTo('App\BorrowRecord');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrowCard()
    {
        return $this->belongsTo('App\BorrowCard');
    }

    public function updateNewBorrowInformation($borrowRecordID, $borrowCardID, $statusBefore, $lentDate, $expiredDate, $borrowFee = null, $prePaid = null)
    {
        $this->setAttribute('borrow_record_id', $borrowRecordID)
            ->setAttribute('borrow_card_id', $borrowCardID)
            ->setAttribute('status_before', $statusBefore)
            ->setAttribute('lent_date', $lentDate)
            ->setAttribute('expired_date', $expiredDate)
            ->setAttribute('borrow_fee', $borrowFee)
            ->setAttribute('pre_paid', $prePaid);

        $this->save();
    }
}
