<?php

namespace App\Http\Controllers;

use App\Service;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaction::with(['service', 'histories']);
        $user = auth()->user();
        
        // client
        if ($user->role_id == 2) {
            $transaksi->where('client_id', $user->id);
        } else if ($user->role_id == 1){
            $transaksi->where('karyawan_id', $user->id); // karyawan
        }

        if ($request->filter == 1) {
            $filter = $this->filter($request, $transaksi);
            $transaksi = $filter['query'];
            $data['filter'] = $filter['filter'];
        }
        
        $transaksi = $transaksi
                    ->with(['teknisi', 'clientDetail'])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
        
        $data['services'] = Service::all();
        $data['list_transaksi'] = $transaksi;
        $data['list_client'] = User::where('role_id', 2)->get();
        $data['list_teknisi'] = User::where('role_id', 1)->get();
        $data['list_status'] = TransactionStatus::all();
        $data['role_id'] = $user->role_id;

        return view('transaksi.index', $data);
    }

    public function filter(Request $request, $query)
    {
        $layanan = $request->layanan;
        $client = $request->client;
        $teknisi = $request->teknisi;
        $status = $request->status;

        if ($request->date_start && $request->date_end) {
            $date_start = Carbon::parse($request->date_start)->startOfDay()->format('Y-m-d H:i:s');
            $date_end = Carbon::parse($request->date_end)->endOfDay()->format('Y-m-d H:i:s');

            $query->where('created_at', '>=', $date_start)
                ->where('created_at', '<=', $date_end);
        }

        if ($layanan) {
            $query->where('jenis_service', $layanan);
        }

        if ($teknisi) {
            $query->where('karyawan_id', $teknisi);
        }

        if ($client) {
            $query->where('client_id', $client);
        }

        if ($status) {
            $query->whereHas('histories', function ($query) use ($status) {
                $query->select('id')
                        ->from('transaction_histories')
                        ->where('transaksi_status_id', '=', $status);
            });
        }

        return [
            'query' => $query,
            'filter' => [
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'layanan' => $layanan,
                'client' => $client,
                'teknisi' => $teknisi,
                'status' => $status
            ]
        ];
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
