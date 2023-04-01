<?php

namespace App\Http\Controllers;

use App\ClientDetail;
use Illuminate\Http\Request;
use App\User;

class ClientController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', 2)->where('is_active', 1);
        $limit = 10;
        $data['user'] = auth()->user();
        $data['clients'] = $user->get();
        $data['total_client'] = $user->count();
        $data['limit'] = $limit;

        return view('clients.index', $data);
    }
}
