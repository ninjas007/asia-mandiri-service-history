<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    public function status()
    {
        return $this->hasOne(TransactionStatus::class, 'id', 'transaksi_status_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaksi_id');
    }
}
