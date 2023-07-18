<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';

    public function transaksi()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaksi_id');
    }

    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

}
