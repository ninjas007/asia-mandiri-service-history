<?php

namespace App\Http\Controllers;

use App\ClientDetail;
use Illuminate\Http\Request;
use App\User;

class ClientController extends Controller
{
    public function index()
    {
        $user = User::with(['client'])->where('role_id', 2)->where('is_active', 1);
        $limit = 10;
        $data['user'] = auth()->user();
        $data['clients'] = $user->get();
        $data['total_client'] = $user->count();
        $data['limit'] = $limit;

        return view('clients.index', $data);
    }

    public function update(Request $request)
    {
        $client_detail = ClientDetail::where('user_id', $request->user_id)->first();
        $client_detail->alamat = $request->alamat;
        $client_detail->no_hp = $request->no_hp;
        $client_detail->nama = $request->nama_client;
        
        $client_detail->save();
    }
}
