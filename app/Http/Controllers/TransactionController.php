<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $data['list_transaksi'] = Transaction::with(['service'])
                                    ->where('karyawan_id', auth()->user()->id)
                                    ->limit(10)
                                    ->get();

        return view('transaksi.index', $data);
    }

    public function show($id)
    {

    }

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
            $transaksi->judul = $request->judul;
            $transaksi->karyawan_id = auth()->user()->id;
            $transaksi->client_id = $request->client_id;
            $transaksi->save();

            // save transaksi detail
            $transaksi_detail = app(\App\Http\Controllers\TransactionDetailController::class)->save($request, $transaksi);

            // save transaksi history
            // save transaksi status 1
            $status_transaksi = 1;
            $transaksi_history = app(\App\Http\Controllers\TransactionHistoryController::class)->save($request, $transaksi, $status_transaksi);

            DB::commit();
        } catch (\Throwable $th) {
            dd($th);

            DB::rollBack();
        }

        return redirect('transaksi');
    }
}
