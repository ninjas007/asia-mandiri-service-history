@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Akun</h5>
                    <div class="card-body">
                        @if (auth()->user()->role_id == 0 && request()->detail != 1)
                            <div class="row">
                                <div class="col-md-6 text-center mb-3">
                                    <div class="form-group border p-3  ">
                                        <i class="fa fa-gears" style="color: ; font-size: 4rem"></i>
                                        <div class="mt-3 font-weight-bold">Teknisi : {{ $total_teknisi }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center mb-3">
                                    <div class="form-group border p-3  ">
                                        <i class="fa fa-users" style="color: ; font-size: 4rem"></i>
                                        <div class="mt-3 font-weight-bold">Clients : {{ $total_client }}</div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <a href="{{ url('akun/add') }}" class="btn btn-success">Tambah Akun</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form action="{{ url('akun') }}/update" method="POST">
                            @csrf
                            @if (request()->detail == 1)
                                @include('akun.form-update-by-admin')
                            @else
                                @include('akun.form-update-own')
                            @endif
                            <div class="form-group mb-3">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        @if (Session::has('success'))
            swal({
                title: "Berhasil!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                button: "Ok",
            });
        @endif

        @if (Session::has('error'))
            swal({
                title: "Gagal!",
                text: "{{ Session::get('error') }}",
                icon: "warning",
                button: "Ok",
            });
        @endif

        $('.show_pass').click(function() {
            const name = $(this).data('name');
            const type = $(`.${name}`).attr('type');

            console.log(name, type)
            if (type == 'text') {
                $(`.${name}`).attr('type', 'password')
            } else {
                $(`.${name}`).attr('type', 'text')
            }
        });
    </script>
@endsection
