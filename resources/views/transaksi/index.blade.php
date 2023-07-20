@extends('layouts.app')

@section('css')
<style>
#tableTransaksi tr td {
    padding: 3px 2px;
}

.list-group-item:hover {
    background: #eeeeee;
}
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center"style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Transaksi {{ auth()->user()->role_id == 0 ? '' : 'Saya' }}</h5>
                    </div>
                    <div class="card-body">
                        @include('transaksi.filter-transaksi')
                    </div>

                    <h5 class="mb-3 mt-5" style="margin-left: 20px">LIST TRANSAKSI</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($list_transaksi as $transaksi)
                            <a href="{{ url('transaksi/' . $transaksi->id . '') }}" style="color: #3e3e3e">
                                <li class="list-group-item py-3 d-flex justify-content-between align-items-center">
                                    <table style="width: 100%" id="tableTransaksi">
                                        <tr class="fw-bold h3">
                                            <td style="width: 35%"><i class="fa fa-bars"></i> Judul Transaksi</td>
                                            <td style="width: 3%">:</td>
                                            <td>
                                                {{ $transaksi->judul ?? '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-wrench"></i> Layanan</td>
                                            <td>:</td>
                                            <td>
                                                {{ $transaksi->service->nama_layanan }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-user"></i> Client</td>
                                            <td>:</td>
                                            <td>
                                                {{ $transaksi->clientDetail->nama_user }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="d-flex justify-content-between mt-3">
                                                    <div class="fw-bold">
                                                        <i class="fa fa-clock"></i> <span class="text-primary">{{ date('d/M/Y H:i:s', strtotime($transaksi->created_at)) }}</span>
                                                    </div>
                                                    <span>Dibuat oleh: {{ $transaksi->teknisi->name }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    @switch($transaksi->attr_latest_history->nama)
                                        @case('PENGERJAAN')
                                            <span class="badge rounded-pill badge-warning p-2">PENGERJAAN</span>
                                            @break
                                        @case('SELESAI')
                                            <span class="badge rounded-pill badge-success p-2">PENGERJAAN</span>
                                            @break
                                        @default
                                    @endswitch
                                </li>
                            </a>
                        @endforeach
                    </ul>

                    <div class="card-footer mt-2">
                        <div class="row">
                            <div class="col-md-6">
                                Total Transaksi : {{ $list_transaksi->total() }}
                            </div>
                            <div class="col-md-6 float-right">
                                {{ $list_transaksi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
