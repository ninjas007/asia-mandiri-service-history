<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'jenis_service');
    }

    public function detailLatest()
    {
        return $this->hasOne(TransactionDetail::class, 'transaction_id', 'id')->latest();
    }

    public function teknisi()
    {
        return $this->hasOne(User::class, 'id', 'karyawan_id');
    }

    public function clientDetail()
    {
        return $this->hasOne(ClientDetail::class, 'id', 'client_id');
    }

    public function getAttrLatestHistoryAttribute()
    {
        return $this->hasOne(TransactionHistory::class, 'transaksi_id', 'id')
                    ->join('transaction_statuses as ts', 'ts.id', '=', 'transaction_histories.transaksi_status_id')
                    ->orderBy('transaction_histories.id', 'DESC')
                    ->first();
    }
}
