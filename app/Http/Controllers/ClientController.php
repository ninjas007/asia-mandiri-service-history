<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ClientController extends Controller
{
    public function index()
    {   
        if (auth()->user()->role_id != 0) {
            return \abort(404);
        }

        $user = User::where('role_id', 2)->where('is_active', 1);
        $limit = 10;
        $data['user'] = auth()->user();
        $data['clients'] = $user->get();
        $data['total_client'] = $user->count();
        $data['limit'] = $limit;

        return view('clients.index', $data);
    }
}
