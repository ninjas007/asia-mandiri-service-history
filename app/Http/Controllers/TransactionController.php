<?php

namespace App\Http\Controllers;

use App\Service;
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
        
        $transaksi = $transaksi
                    ->with(['teknisi', 'clientDetail'])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
        
        $data['services'] = Service::all();
        $data['list_transaksi'] = $transaksi;

        return view('transaksi.index', $data);
    }

    public function show($id)
    {
        $data['transaksi'] = Transaction::findOrFail($id);
        $data['transaksi_detail'] = TransactionDetail::with(['transaksi', 'created_by'])->where('transaksi_id', $id)->get();

        return view('transaksi.detail', $data);
    }

    public function save(Request $request)
    {
        $transaksi_id = $request->transaksi_id ?? null;

        // validasi
        $validator = Validator::make($request->all(), [
            'kompresor' => 'required',
            'condensor' => 'required',
            'motor_fan' => 'required',
            'evoprator' => 'required',
            'motor_blower' => 'required',
            'capasitor' => 'required',
            'pipa_drainase' => 'required',
        ]);

        // cek validasi
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Inputan belum sesuai, periksa kembail');
        }

        try {
            DB::beginTransaction();

            $foto = app(TransactionImagesController::class)->getDataWhere($request->uniq_string, ['file_name', 'uniq_string'])->toArray();

            // kalau sudah ada transaksisnya
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
            app(TransactionDetailController::class)->save($request, $transaksi, $foto);

            // save transaksi history
            // save transaksi status 1
            app(TransactionHistoryController::class)->save($transaksi, 1);

            // hapus data di transaction images jika sudah save
            app(TransactionImagesController::class)->destroy($request->uniq_string);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            if (config('app.debug')) dd($th);

            return redirect()->back()->with('error', 'Terdapat kesalahan, Gagal membuat transaksi');
        }

        return redirect('transaksi/'.$transaksi->id)->with('success', 'Berhasil membuat transaksi');
    }

    /**
     * query remove transaksi by ORM
     * 
     * @param string|integer transaksi id
     * 
     * @return void
     */
    public function delete($transaksi_id)
    {
        Transaction::where('id', '=', $transaksi_id)->first()->delete();
    }

    /**
     * method to remove transaksi with relationship
     * 
     * @param Request $request
     * @param string|integer transaksi id
     * @
     *
     * @return json
     */
    public function destroy(Request $request, $transaksi_id)
    {
        try {
            DB::beginTransaction();

            // hapus transaksi
            app(TransactionController::class)->delete($transaksi_id);
                
            // hapus semua transaksi status
            app(TransactionHistoryController::class)->delete($transaksi_id);

            // hapus semua gambar
            app(TransactionImagesController::class)->deleteImages(
                app(TransactionDetailController::class)->destroyDetailByTransaksiId($request, $transaksi_id),
                'transaction'
            ); 

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            if (config('app.debug')) dd($th);

            return response()->json([
                'message' => 'Terdapat kesalahan, Gagal menghapus transaksi', 
                'redirect' => '/transaksi',
                'status' => 'error',
            ]);
        }
        
        return response()->json([
            'message' => 'Berhasil menghapus transaksi', 
            'redirect' => '/transaksi',
            'status' => 'success'
        ]);
    }

    /**
     * method to destroy trankasi from transaction detail request
     * 
     * @param Request $reqeust
     * @param string transaksi id
     * 
     * @return void
     */
    public function destroyByTransactionDetail(Request $request, $transaksi_id)
    {
        // get query ORM to delete
        app(TransactionController::class)->delete($transaksi_id);
            
        // hapus semua transaksi status
        app(TransactionHistoryController::class)->delete($transaksi_id);
    }
}
