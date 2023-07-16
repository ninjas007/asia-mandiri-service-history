<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function save(Request $request, $transaksi, $data_foto = [])
    {
        $data = [
            'kompresor' => $request->kompresor ?? null,
            'condensor' => $request->condensor ?? null,
            'motor_fan' => $request->motor_fan ?? null,
            'evoprator' => $request->evoprator ?? null,
            'motor_blower' => $request->motor_blower ?? null,
            'capasitor' => $request->capasitor ?? null,
            'pipa_drainase' => $request->pipa_drainase ?? null,
        ];

        $transaksi_detail = new TransactionDetail;
        $transaksi_detail->transaksi_id = $transaksi->id;
        $transaksi_detail->detail = json_encode($data);
        $transaksi_detail->photos = json_encode($data_foto);
        $transaksi_detail->deskripsi_service = json_encode($request->deskripsi_service);
        $transaksi_detail->tanggal_pengerjaan = now();
        $transaksi_detail->save();

        return $transaksi_detail;
    }
}
