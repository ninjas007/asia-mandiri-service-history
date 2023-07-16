<?php

namespace App\Http\Controllers;

use App\TransactionImages;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function trxImageUpload(Request $request)
    {
        $uniq_string = $request->uniq_string;
        $file_id = $request->file_id;

        if ($request->has('images') && $file_id) {
            $files = $request->file('images');

            $file_name = $files->getClientOriginalName();

            // move to folder
            $files->move('transaction', $file_name); 

            // save to db
            TransactionImages::create([
                'uniq_string' => $uniq_string,
                'file_id' => $file_id,
                'file_name' => $file_name
            ]);


            return $uniq_string;
        }

        return '';
    }

    public function trxImageDelete(Request $request)
    {
        $file_id = $request->file_id;
        if ($file_id) {
            $temporary_file = TransactionImages::where('file_id', $file_id)->first();
            $temporary_file->delete(); // remove dari db

            // remove filenya
            $filePath = public_path('transaction/' . $temporary_file->file_name);
            if (file_exists($filePath)) {
                unlink($filePath); // hapus file dari folder public/tmp
            }
        }
    }
}
