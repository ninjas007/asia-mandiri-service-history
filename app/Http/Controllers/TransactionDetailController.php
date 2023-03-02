<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function save(Request $request, $transaksi)
    {
        $data = [
            'merk_type_ac' => $request->merk_type_ac,
            'pk' => $request->pk,
            'freon' => $request->freon,
            'ampere' => $request->merk_type_ac,
            'kompresor' => $request->kompresor ?? null,
            'condensor' => $request->condensor ?? null,
            'motor_fan' => $request->motor_fan ?? null,
            'evoprator' => $request->evoprator ?? null,
            'motor_blower' => $request->motor_blower ?? null,
            'capasitor' => $request->capasitor ?? null,
            'pipa_drainase' => $request->pipa_drainase ?? null,
            'kelistrikan' => $request->kelistrikan,
            'keterangan' => $request->keterangan
        ];

        $transaksi_detail = new TransactionDetail;
        $transaksi_detail->transaksi_id = $transaksi->id;
        $transaksi_detail->detail = json_encode($data);
        $transaksi_detail->tanggal_pengerjaan = now();
        $transaksi_detail->save();

        return $transaksi_detail;
    }
}
