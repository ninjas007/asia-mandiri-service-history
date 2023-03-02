@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center"style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Transaksi Saya</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($list_transaksi as $transaksi)
                            <a href="{{ url('transaksi/' . $transaksi->id . '') }}" style="color: #3e3e3e">
                                <li class="list-group-item py-3">
                                    Judul Transaksi : {{ $transaksi->judul }} <br>
                                    Layanan : {{ $transaksi->service->nama_layanan }} <br>
                                    {{ date('d/M/Y H:i:s', strtotime($transaksi->created_at)) }} -
                                    <b>{{ $transaksi->attr_latest_history->nama }}</b> <br>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
