<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    
    public function uploadGambar($files)
    {
        // request()->validate([
        //     'file'  => 'required|mimes:doc,docx,pdf,txt|max:2048',
        // ]);

        // $files = $request->file('file');
        $file = null;
        if ($files) {
            $destinationPath = 'images/'; // upload path
            $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $file);
         }


        return $file;
    }

    public static function handleError($exception, $message = ['error' => 'Terjadi Kesalahan Server'])
    {
        if (config('app.debug') == true) {
            dd($exception);
        }
        
        return $message;
    }

    public function notFound()
    {
        return view('templates.404');
    }
}
