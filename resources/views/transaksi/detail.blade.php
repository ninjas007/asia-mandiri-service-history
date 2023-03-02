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
                        <h5 class="mb-3">{{ $transaksi->judul }}</h5>
                        @foreach ($transaksi_detail as $i => $detail)
                            <div class="py-1">
                                {{-- service ac --}}
                                @if ($detail->transaksi->jenis_service == 1)
                                    @include('services.ac.detail')
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <div class="mb-1">Tambah item baru untuk transaksi ini</div> <br>
                        <a href="{{ url('teknisi/client?client_id='.$transaksi->client_id.'&transaksi_id='.$transaksi->id.'') }}" class="btn btn-primary">tambah item</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
