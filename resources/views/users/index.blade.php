@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Detail Akun</h5>
                    <div class="card-body">
                        <form action="{{ url('akun') }}/save" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password Lama</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control password_lama" placeholder="Password lama"
                                        name="password_lama">
                                    <div class="input-group-append">
                                        <span class="input-group-text show_pass" data-name="password_lama"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password Baru</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control password_baru" placeholder="Password baru"
                                        name="password_baru">
                                    <div class="input-group-append">
                                        <span class="input-group-text show_pass" data-name="password_baru"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">User Terdaftar</label>
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                            </div>
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
