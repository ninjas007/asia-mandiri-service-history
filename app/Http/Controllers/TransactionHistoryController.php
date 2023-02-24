<?php

namespace App\Http\Controllers;

use App\TransactionHistory;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    /**
     * @property Illuminate\Http\Request $request
     * @property App\Transaksi $transksi
     * @property int $status_id
     */
    public function save(Request $request, $transaksi, $status_id = 1)
    {
        $transaksi_history = new TransactionHistory;
        $transaksi_history->transaksi_status_id = $status_id;
        $transaksi_history->transaksi_id = $transaksi->id;

        $transaksi_history->save();
    }
}
