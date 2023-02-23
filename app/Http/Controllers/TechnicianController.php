<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use App\ClientDetail;
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
        $clients = User::where('role_id', 2)->with('client')->get();

        return view('teknisi.index', [
            'clients' => $clients
        ]);
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

        $client = User::selectRaw('client_details.*, client_details.id as client_id, users.name as nama_user')
                        ->join('client_details', 'users.id', '=', 'client_details.user_id')
                        ->where('users.role_id', 2)
                        ->where('users.name', 'LIKE', '%'.$search.'%')
                        ->orWhere('client_details.nama', 'LIKE', '%'.$search.'%')
                        ->limit(5)
                        ->get();

        return response()->json($client);
    }

    public function client(Request $request, $client_id)
    {
        $data['client'] = ClientDetail::findOrFail($client_id)->with('user')->first();
        $data['services'] = Service::get();

        return view('teknisi.client', $data);
    }

    public function clientService($client_id, $service_id)
    {
        // $data['template_service'] = Service::where('id', $service_id)->with('template')->first();
        $data['template_service'] = Service::where('id', $service_id)->first();
        $data['client'] = ClientDetail::findOrFail($client_id)->with('user')->first();

        $html = 'Not found';
        if ($data['template_service']) {
            $html = view('teknisi.service', $data)->render();
        }

        return $html;
    }

}
