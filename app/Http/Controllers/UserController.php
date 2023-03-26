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
            $data['user'] = User::with(['client', 'teknisi'])->where('id', $request->user_id)->first();
        } else {
            $data['total_client'] = User::where('role_id', '=', 2)->count();
            $data['total_teknisi'] = User::where('role_id', '=', 1)->count();
        }

        return view('akun.index', $data);
    }

    public function add()
    {
        return view('akun.add');
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

        $user->save();

        if ($update_by_admin) {
            if ($user->role_id == 2) {
                app(ClientController::class)->update($request);
            }

            if ($user->role_id == 1) {
                app(TeknisiController::class)->update($request);
            }
        }

        return redirect('akun')->with(['success' => 'Berhasil mengubah data']);
    }

    public function save(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'is_active' => 1,
                'role_id' => $request->role
            ]);

            if ($request->role == 2) {
                $client = new ClientDetail();
                $client->nama = $request->nama_client;
                $client->alamat = $request->alamat;
                $client->no_hp = $request->no_hp;
                $client->user_id = $user->id;

                $client->save();
                $success = 'Berhasil menambah client';
            }
            else if ($request->role == 1) {
                $teknisi = new TeknisiDetail();
                $teknisi->user_id = $user->id;
                $teknisi->alamat = $teknisi->alamat;
                $teknisi->no_hp = $teknisi->no_hp;

                $teknisi->save();
                $success = 'Berhasil menambah teknisi';
            }

            DB::commit();

            $return = [
                'success' => $success
            ];
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();
            HelperController::handleError($th);
        }

        return redirect('akun')->with($return);
    }
}
