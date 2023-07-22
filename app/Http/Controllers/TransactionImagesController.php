<?php

namespace App\Http\Controllers;

use App\TransactionImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TransactionImagesController extends Controller
{
    public function getDataWhere($where, $get = null)
    {
        $transaksi_images = TransactionImages::where('uniq_string', $where);

        if ($get) {
            return $transaksi_images->get($get);
        }

        return $transaksi_images->get();
    }

    /**
     * remove data transaction images
     * 
     * @param string uniq string from request
     * 
     * @return void
     */
    public function destroy($uniq_string)
    {
        TransactionImages::where('uniq_string', $uniq_string)->delete();
    }

    /**
    * @param array image file name
    * @param string path files
    * 
    * @return void
    */
    public function deleteImages($images, $location = 'transaction')
    {
        foreach ($images as $image) {
            $file_path = public_path($location . '/' . $image);
    
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }
    }
}
