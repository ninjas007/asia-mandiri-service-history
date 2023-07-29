<div class="card mb-3">
    <div class="card-header">
        <h5>Data Client / Toko</h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action" style="padding-left: 5px">Nama: {{ $client->nama_user }}</li>
            <li class="list-group-item list-group-item-action" style="padding-left: 5px">Nomor HP: {{ $client->nohp_user }}</li>
            <li class="list-group-item list-group-item-action" style="padding-left: 5px">Alamat: {{ $client->alamat_user }}</li>
            @if (request()->get('transaksi_id') || isset($edit))
                <li class="list-group-item list-group-item-action" style="padding-left: 5px">web : {{ $transaksi->judul }}</li>
            @endif
        </ul>
    </div>
</div>