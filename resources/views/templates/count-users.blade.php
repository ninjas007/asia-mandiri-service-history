@if (auth()->user()->role_id == 0 && request()->detail != 1 && Request::segment(1) == 'akun')
    <div class="row">
        <a href="{{ url('akun/teknisi') }}" class="col-md-6 text-center mb-3">
            <div class="form-group border p-3 {{ $page == 'teknisi' ? 'bg-dark text-white' : '' }}">
                <i class="fa fa-gears" style="color: ; font-size: 4rem"></i>
                <div class="mt-3 font-weight-bold">Teknisi : {{ $total_teknisi }}</div>
            </div>
        </a>
        <a href="{{ url('akun/client') }}" class="col-md-6 text-center mb-3">
            <div class="form-group border p-3 {{ $page == 'client' ? 'bg-dark text-white' : '' }}">
                <i class="fa fa-users" style="color: ; font-size: 4rem"></i>
                <div class="mt-3 font-weight-bold">Clients : {{ $total_client }}</div>
            </div>
        </a>

        <div class="col-md-12 mb-3">
            <div class="form-group">
                <a href="{{ url('akun/add') }}" class="btn btn-success">Tambah Akun</a>
            </div>
        </div>
    </div>
    <hr>
@endif