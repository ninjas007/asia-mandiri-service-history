<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function save(Request $request, $transaksi)
    {
        $data = [];
        $length = count($request->pk);
        for ($i = 0; $i < $length; $i++) {
            $data[] = [
                'merk_type_ac' => $request->merk_type_ac[$i],
                'pk' => $request->pk[$i],
                'freon' => $request->freon[$i],
                'ampere' => $request->merk_type_ac[$i],
                'kompresor' => $request->kompresor[$i] ?? null,
                'condensor' => $request->condensor[$i] ?? null,
                'motor_fan' => $request->motor_fan[$i] ?? null,
                'evoprator' => $request->evoprator[$i] ?? null,
                'motor_blower' => $request->motor_blower[$i] ?? null,
                'capasitor' => $request->capasitor[$i] ?? null,
                'pipa_drainase' => $request->pipa_drainase[$i] ?? null,
                'kelistrikan' => $request->kelistrikan[$i],
                'keterangan' => $request->keterangan[$i]
            ];
        }

        $transaksi_detail = new TransactionDetail;
        $transaksi_detail->transaksi_id = $transaksi->id;
        $transaksi_detail->detail = json_encode($data);
        $transaksi_detail->tanggal_pengerjaan = now();
        $transaksi_detail->status_pengerjaan = 1;
        $transaksi_detail->save();

        return $transaksi_detail;
    }
}
