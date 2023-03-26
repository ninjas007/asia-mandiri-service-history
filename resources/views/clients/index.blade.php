@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Clients</h5>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="searchClient">Cari Client</label>
                            <input type="text" id="searchClient" class="form-control"
                                placeholder="Ketik nama user, nama outlet atau alamat outlet"
                                onkeypress="searchInput(this, event)">
                        </div>

                        <h6>List Client</h6>

                        @foreach ($clients as $i => $client)
                            <div class="my-1 border p-2" data-mdb-toggle="collapse" href="#collapseExample{{ $i }}" role="button"
                                aria-expanded="false" aria-controls="collapseExample{{ $i }}">
                                <b>{{ $client->name }} - {{ $client->client->nama }}</b>
                            </div>

                            <div class="collapse my-2" id="collapseExample{{ $i }}">
                                <table style="width: 100%">
                                    <tr>
                                        <td width="15%"
                                            style="text-transform: capitalize; padding-left: 5px; vertical-align: top">
                                            Email</td>
                                        <td width="2%" style=" vertical-align: top">:</td>
                                        <td width="83%">{{ $client->email }}</td>
                                        <td rowspan="3">
                                            <a href="{{ url('akun?detail=1&user_id='.$client->id.'') }}" class="btn btn-primary" title="Detail"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%"
                                            style="text-transform: capitalize; padding-left: 5px; vertical-align: top">
                                            No HP</td>
                                        <td width="2%" style=" vertical-align: top">:</td>
                                        <td width="83%">{{ $client->client->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%"
                                            style="text-transform: capitalize; padding-left: 5px; vertical-align: top">
                                            Alamat</td>
                                        <td width="2%" style=" vertical-align: top">:</td>
                                        <td width="83%">{{ $client->client->alamat }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach

                        <button class="btn btn-success mt-3 form-control">Show More</button>
                        <div class="mt-3">Total Client : {{ $total_client }}</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('akun/add') }}" class="btn btn-primary mt-2">Tambah Client</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
