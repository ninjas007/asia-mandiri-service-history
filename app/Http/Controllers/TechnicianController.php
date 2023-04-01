<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use App\ClientDetail;
use App\TeknisiDetail;
use App\Transaction;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::where('role_id', 2)->where('is_active', 1)->get();

        return view('teknisi.index', [
            'clients' => $clients
        ]);
    }

    public function update(Request $request)
    {
        $teknisi_detail = User::where('id', $request->user_id)->first();
        $teknisi_detail->alamat = $request->alamat;
        $teknisi_detail->no_hp = $request->no_hp;
        
        $teknisi_detail->save();
    }

    /**
     * Search the client
     * @param \Illuminate\Http\Request $request;
     *
     * @return \Illuminate\Http\Response
     */
    public function searchClient(Request $request)
    {
        $search = $request->search;

        $client = User::where('role_id', 2)
                        ->where('is_active', 1)
                        ->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('nama_user', 'LIKE', '%'.$search.'%')
                        ->limit(20)
                        ->get();

        return response()->json($client);
    }

    public function client(Request $request)
    {
        $client_id = $request->client_id;
        $transaksi_id = $request->transaksi_id;

        if ($transaksi_id) {
            $data['transaksi'] = Transaction::findOrFail($transaksi_id);
        }

        $data['client'] = User::where('id', $client_id)->first();
        $data['services'] = Service::get();

        return view('teknisi.client', $data);
    }

    public function clientService(Request $request)
    {
        // $data['template_service'] = Service::where('id', $service_id)->with('template')->first();
        $client_id = $request->client_id;
        $service_id = $request->service_id;
        $data['template_service'] = Service::where('id', $service_id)->first();
        $data['client'] = User::findOrFail($client_id);

        $html = 'Not found';
        if ($data['template_service']) {
            $html = view('teknisi.service', $data)->render();
        }

        return $html;
    }

}
