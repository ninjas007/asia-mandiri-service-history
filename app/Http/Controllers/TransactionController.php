<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function save(Request $request)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            // 'kompresor' => 'required',
            // 'condensor' => 'required',
            // 'motor_fan' => 'required',
            // 'evoprator' => 'required',
            // 'motor_blower' => 'required',
            // 'capasitor' => 'required',
            // 'pipa_drainase' => 'required',
        ]);

        // cek validasi
        if ($validator->fails()) {
            dd($validator);
        }

        try {
            DB::beginTransaction();

            // save transaksi
            $transaksi = new Transaction;
            $transaksi->jenis_service = $request->jenis_service;
            $transaksi->karyawan_id = auth()->user()->id;
            $transaksi->status_akhir = 1;
            $transaksi->client_id = $request->client_id;
            $transaksi->save();


            // save transaksi detail
            $transaction_detail = app(\App\Http\Controllers\TransactionDetailController::class)->save($request, $transaksi);

            DB::commit();
        } catch (\Throwable $th) {
            dd($th);

            DB::rollBack();
        }


        return $transaction_detail;
    }
}
