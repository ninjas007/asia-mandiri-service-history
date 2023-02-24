@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="margin-bottom: 5px">Transaksi</div>
                <ul>
                    @foreach ($list_transaksi as $transaksi)
                    {{-- {{ dd($transaksi->attr_latest_history) }} --}}
                        <li>
                            Judul Transaksi : {{ $transaksi->judul }} <br> Layanan : {{ $transaksi->service->nama_layanan }}
                            <br>
                            {{ date('d/M/Y H:i:s', strtotime($transaksi->created_at)) }} - <b>{{ $transaksi->attr_latest_history->nama }}</b>
                            <a href="{{ url('transaksi/'.$transaksi->id.'') }}">Lihat Detail</a>
                            <br>
                            <br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
