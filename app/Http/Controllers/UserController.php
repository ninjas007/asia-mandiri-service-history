<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\ClientDetail;
use App\TeknisiDetail;
use Illuminate\Support\Facades\Validator;
use DB;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $data['user'] = auth()->user();

        if (isset($request->user_id)) {
            $data['user'] = User::where('id', $request->user_id)->first();
        } else {
            $data['total_client'] = User::where('role_id', '=', 2)->count();
            $data['total_teknisi'] = User::where('role_id', '=', 1)->count();
        }

        return view('akun.index', $data);
    }

    public function add(Request $request)
    {
        $data['add_client'] = $request->add_client ?? null;
        return view('akun.add', $data);
    }

    public function update(Request $request)
    {
        $update_by_admin = $request->update_by_admin;

        if ($update_by_admin) {
            $user = User::where('id', $request->user_id)->first();
        } else {
            $user = User::where('id', auth()->user()->id)->first();
            // check password lama
            if (!Hash::check($request->password_lama, $user->password)) {
                return redirect('akun')->with(['error' => 'Password lama salah!']);
            }

            $user->password = Hash::make($request->password_baru);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->role_id == 2 && $update_by_admin) {
            $user->alamat_user = $request->alamat;
            $user->nohp_user = $request->no_hp;
            $user->nama_user = $request->nama_client;
        }

        if ($user->role_id == 1 && $update_by_admin) {
            $user->alamat_user = $request->alamat;
            $user->nohp_user = $request->no_hp;
        }

        $user->save();

        return redirect('akun')->with(['success' => 'Berhasil mengubah data']);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('akun')->with(['error' => 'Gagal menambah data validasi ada yang salah']);
            // return view('my-form')->withErrors($validator);
        }

        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'is_active' => 1,
                'role_id' => $request->role
            ];

            if ($request->role == 2 && $request->role == 1) {
                $data['alamat_user'] = $request->alamat;
                $data['nohp_user'] = $request->no_hp;

                if ($request->role == 2) {
                    $data['nama_user'] = $request->nama_client;
                }
            }

            User::create($data);

            DB::commit();

            $return = [
                'success' => 'Berhsasil menambah data'
            ];
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();
            HelperController::handleError($th);
        }

        return redirect('akun')->with($return);
    }
}
