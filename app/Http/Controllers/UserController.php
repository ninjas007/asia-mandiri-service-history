<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Helper;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $role_slug = $request->segment(2);
        $role_id = Helper::roleIdBySlug($role_slug); // result: teknisi or client id nya
        
        $data['user'] = auth()->user();
        $data['page'] = $role_slug;
        $data['total_client'] = User::where('role_id', '=', 2)->count();
        $data['total_teknisi'] = User::where('role_id', '=', 1)->count();

        if ($role_id) {
            $data['list_user'] = User::withCount('transactions')
                                    ->where('role_id', '=', $role_id)
                                    ->get()
                                    ->sortByDesc('created_at');
        }

        return view('akun.index', $data);
    }

    public function add(Request $request)
    {
        $data['add_client'] = $request->add_client ?? null;
        
        return view('akun.add', $data);
    }

    public function detail(Request $request, $user_id)
    {
        $data['user'] =  User::findOrFail($user_id);

        return view('akun.detail', $data);
    }

    public function update(Request $request)
    {
        $update_by_admin = $request->update_by_admin;
        $redirect = 'akun';

        // validasi password kalau ganti password
        if ($request->change_password) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ], [
                'password.min' => 'Old password must be at least :min characters.',
                'password_confirmation.string' => 'New Password must be a string.',
                'password_confirmation.min' => 'New Password must be at least :min characters.'
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);
        }
        
        if ($update_by_admin) {
            $user = User::where('id', $request->user_id)->first();
        } else {
            $user = User::where('id', auth()->user()->id)->first();
        }

        // kalau ganti password
        if ($request->change_password) {
            // check password lama jika bukan admin yang update
            if (!$update_by_admin && !Hash::check($request->password, $user->password)) {
                return redirect()->back()->with(['error' => 'Password lama salah!']);
            }

            $user->password = Hash::make($request->password_confirmation);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->role_id == 2 && $update_by_admin) {
            $user->alamat_user = $request->alamat;
            $user->nohp_user = $request->no_hp;
            $user->nama_user = $request->nama_client;

            $redirect = 'akun/client';
        }

        if ($user->role_id == 1 && $update_by_admin) {
            $user->alamat_user = $request->alamat;
            $user->nohp_user = $request->no_hp;

            $redirect = 'akun/teknisi';
        }

        $user->save();

        return redirect($redirect)->with(['success' => 'Berhasil mengubah data']);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed'
        ], [
            'password.required' => 'Password field is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least :min characters.',
            'password.confirmed' => 'Password need confirmed',
        ]);

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
                'success' => 'Berhasil menambah data'
            ];
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollback();
            HelperController::handleError($th);
        }

        return redirect('akun')->with($return);
    }

    public function remove(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->delete();

        return response()->json(['success' => 'User berhasil terhapus']);
    }
}
