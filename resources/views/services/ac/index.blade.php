<form action="{{ url('transaksi/save') }}" method="POST" style="padding-bottom: 10rem">
    @csrf
    <input type="hidden" value="{{ $template_service->slug }}" id="slug">
    <input type="hidden" value="{{ $template_service->id }}" name="jenis_service">
    <input type="hidden" value="{{ $client->id }}" name="client_id">
    <input type="hidden" value="{{ request()->get('transaksi_id') }}" name="transaksi_id">

    <div class="row mb-3 {{ request()->get('transaksi_id') ? 'd-none' : '' }}">
        <div class="col-md-12">
            <div class="form-group">
                <label for="judul">Judul Transaksi</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul Transaksi. Misal: Cuci AC">
            </div>
        </div>
    </div>

    @include('services.ac.form')

    {{-- <button class="hapus-row"
    onclick="hapusInput(`{{ $template_service->slug }}`, this)">Delete</button>
    <button type="button" id="tambah-input-{{ $template_service->slug }}" onclick="tambahInput(`{{ $template_service->slug }}`)" class="btn btn-primary">
        Tambah Inputan
    </button> --}}
    <div class="row mb-3">
        <div class="col-12">
            <button type="submit" class="btn btn-success form-control">Simpan</button>
        </div>
    </div>
</form>
