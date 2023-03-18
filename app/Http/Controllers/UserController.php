<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = User::findOrFail(auth()->user()->id);

        return view('users.index', $data);
    }

    public function save(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();

        // check password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect('akun')->with(['error' => 'Password lama salah!']);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password_baru);

        $user->save();

        return redirect('akun')->with(['success' => 'Berhasil mengubah data']);
    }
}
