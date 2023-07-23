<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $transaksi_detail->created_by = auth()->user()->id;
        $transaksi_detail->save();

        return $transaksi_detail;
    }

    public function update(Request $request, $transaksi_detail_id)
    {
        try {
            DB::beginTransaction();

            $data = [
                'kompresor' => $request->kompresor ?? null,
                'condensor' => $request->condensor ?? null,
                'motor_fan' => $request->motor_fan ?? null,
                'evoprator' => $request->evoprator ?? null,
                'motor_blower' => $request->motor_blower ?? null,
                'capasitor' => $request->capasitor ?? null,
                'pipa_drainase' => $request->pipa_drainase ?? null,
            ];
    
            $transaksi_detail = TransactionDetail::where('id', $transaksi_detail_id)->first();
    
            $transaksi_detail->detail = json_encode($data);
            $transaksi_detail->deskripsi_service = json_encode($request->deskripsi_service);
            $transaksi_detail->updated_at = now();
            $transaksi_detail->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            if(config('app.debug')) dd($th);

            return redirect()->back()->with('error', 'Terdapat kesalahan, Gagal mengubah transaksi detail');
        }

        return redirect('transaksi/'.$transaksi_detail->transaksi_id)->with('success', 'Berhasil mengubah transaksi detail');
    }

    public function getTransactionDetailById($transaksi_detail_id)
    {
        return TransactionDetail::where('id', $transaksi_detail_id)->first();
    }

    /**
     * orm to remove transaksi detail, single delete
     * 
     * @param Request $request
     * @param string|integer transaksi detail id
     * 
     * @return void
     */
    public function delete(Request $request, $transaksi_detail_id)
    {
        TransactionDetail::where('id', '=', $transaksi_detail_id)->first()->delete();
    }

    /**
     * orm to get total transaksi detail
     * 
     * @param string|integer transaksi detail id
     * 
     * @return void
     */
    public function total($transaksi_id)
    {
        return TransactionDetail::where('transaksi_id', '=', $transaksi_id)->count();
    }

    /**
     * @param string images json
     * 
     * @return array photos
     */
    public function getPhotos($images)
    {
        $photos = [];
        $images = json_decode($images);
        foreach ($images as $image) {
            $photos[] = $image->file_name;
        }

        return $photos;
    }

    /**
     * @param Request $request
     * @param string transaksi id
     * 
     * @return array file name
     */
    public function destroyDetailByTransaksiId(Request $request, $transaksi_id)
    {
        $transaksi_detail = TransactionDetail::where('transaksi_id', $transaksi_id)->get();
        $trx_detail_ids = TransactionDetail::where('transaksi_id', $transaksi_id)->pluck('id')->toArray();

        // hapus transaksi detail
        TransactionDetail::destroy($trx_detail_ids);

        // untuk hapus images nantinya
        $photos = [];
        foreach ($transaksi_detail as $detail) {
            $photo = $this->getPhotos($detail->photos);
            $photos[] = $photo;
        }

        return collect($photos)->collapse()->toArray();
    }

    /**
     * remove transaksi detail single
     * 
     * @param Request $request 
     * @param string transaksi id
     * 
     * @return json
     */
    public function destroy(Request $request, $transaksi_detail_id)
    {
        $transaksi_detail = TransactionDetail::where('id', $transaksi_detail_id)->first();
        $transaksi_id = $transaksi_detail_id = $transaksi_detail->transaksi_id;
        $redirect = '/transaksi/'.$transaksi_id;

        try {
            DB::beginTransaction();

            app(TransactionDetailController::class)->delete($request, $transaksi_detail_id);

            // cek transaksi detail
            if ($this->total($transaksi_id) == 0) {
                $redirect = '/transaksi';

                // hapus transaksi
                app(TransactionController::class)->destroyByTransactionDetail($request, $transaksi_id);
            }

            // delete image dari folder jika semua db telah di eksekusi
            app(TransactionImagesController::class)
                ->deleteImages(
                    $this->getPhotos($transaksi_detail->photos), 
                    'transaction'
                );

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            if (config('app.debug')) dd($th);

            return response()->json([
                    'message' => 'Terdapat kesalahan, Gagal menghapus transaksi', 
                    'redirect' => $redirect,
                    'status' => 'error',
                ]);
        }
        
        return response()->json([
            'message' => 'Berhasil menghapus transaksi', 
            'redirect' => $redirect,
            'status' => 'success'
        ]);
    }
}
