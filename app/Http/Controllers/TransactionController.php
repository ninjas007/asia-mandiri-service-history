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
        $transaksi = Transaction::with(['service']);

        // client
        if (auth()->user()->role_id == 2) {
            $transaksi->where('client_id', auth()->user()->id);
        } else if (auth()->user()->role_id == 1){
            $transaksi->where('karyawan_id', auth()->user()->id); // karyawan
        }
        
        $transaksi = $transaksi->limit(10)->get();

        $data['list_transaksi'] = $transaksi;

        return view('transaksi.index', $data);
    }

    public function show($id)
    {
        $data['transaksi'] = Transaction::findOrFail($id);
        $data['transaksi_detail'] = TransactionDetail::with('transaksi')->where('transaksi_id', $id)->get();

        return view('transaksi.detail', $data);
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

        // validasi gambar
        // Validasi isian form
        // $request->validate([
        //     'foto_capasitor' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'foto_pipadrainese' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'foto_pipadrainese' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'foto_pipadrainese' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        try {
            DB::beginTransaction();

            $transaksi_id = $request->transaksi_id ?? null;

            $foto = [
                'foto_kompresor' => app(HelperController::class)->uploadGambar($request->file('foto_kompresor')),
                'foto_condensor' => app(HelperController::class)->uploadGambar($request->file('foto_condensor')),
                'foto_motorfan' => app(HelperController::class)->uploadGambar($request->file('foto_motorfan')),
                'foto_evoprator' => app(HelperController::class)->uploadGambar($request->file('foto_evoprator')),
                'foto_motorblower' => app(HelperController::class)->uploadGambar($request->file('foto_motorblower')),
                'foto_capasitor' => app(HelperController::class)->uploadGambar($request->file('foto_capasitor')),
                'foto_pipadrainese' => app(HelperController::class)->uploadGambar($request->file('foto_pipadrainese')),
            ];

            // kalau tidak di set transaksi idnya
            if ($transaksi_id) {
                $transaksi = Transaction::findOrFail($transaksi_id);
            } else {
                // save transaksi
                $transaksi = new Transaction;
                $transaksi->jenis_service = $request->jenis_service;
                $transaksi->judul = $request->judul;
                $transaksi->karyawan_id = auth()->user()->id;
                $transaksi->client_id = $request->client_id;
                $transaksi->save();
            }

            // save transaksi detail
            app(\App\Http\Controllers\TransactionDetailController::class)->save($request, $transaksi, $foto);

            // save transaksi history
            // save transaksi status 1
            $status_transaksi = 1;
            app(\App\Http\Controllers\TransactionHistoryController::class)->save($transaksi, $status_transaksi);

            DB::commit();
        } catch (\Throwable $th) {
            dd($th);

            DB::rollBack();
        }

        return redirect('transaksi/'.$transaksi->id);
    }
}
