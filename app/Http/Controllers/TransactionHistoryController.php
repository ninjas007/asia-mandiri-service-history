<?php

namespace App\Http\Controllers;

use App\TransactionHistory;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    /**
     * @property Illuminate\Http\Request $request
     * @property int $transksi_id
     * @property int $status_id
     */
    public function save($transaksi_id, $status_id = 1, $is_update = false)
    {
        $transaksi_history = new TransactionHistory;
        $transaksi_history->transaksi_status_id = $status_id;
        $transaksi_history->transaksi_id = $transaksi_id;

        if ($is_update) {
            $transaksi_history->updated_by = auth()->user()->id;
        }

        $transaksi_history->save();
    }

    public function delete($transaksi_id)
    {
        $trx_history_ids = TransactionHistory::where('transaksi_id', $transaksi_id)->pluck('id')->toArray();

        TransactionHistory::destroy($trx_history_ids);
    }
}
