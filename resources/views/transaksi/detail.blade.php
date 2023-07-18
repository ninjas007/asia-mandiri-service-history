@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center"style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Transaksi Detail</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-3 text-weight-bold">Judul Transaksi: {{ $transaksi->judul }}</h5>
                        @foreach ($transaksi_detail as $i => $detail)
                            <div class="py-1">
                                {{-- service ac --}}
                                @if ($detail->transaksi->jenis_service == 1)
                                    @include('services.ac.detail')
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if (auth()->user()->role_id == 1)
                        <div class="card-footer">
                            <div class="list-group list-group-light">
                                <a href="{{ url('teknisi/client?client_id=' . $transaksi->client_id . '&transaksi_id=' . $transaksi->id . '') }}" class="text-primary list-group-item list-group-item-action px-3 border-0 ripple" aria-current="true">
                                   <i class="fa fa-plus"></i> Tambah item baru untuk transaksi ini
                                </a>
                                <a href="{{ url('teknisi/client?client_id=' . $transaksi->client_id) }}" class="text-primary list-group-item list-group-item-action px-3 border-0 ripple" aria-current="true">
                                   <i class="fa fa-plus"></i> Tambah transaksi baru untuk client ini
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
