@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Akun</h5>
                    <div class="card-body">

                        @include('templates.count-users')

                        @if (Request::segment(1) == 'akun' && ($page == 'teknisi' || $page == 'client'))
                            {{-- hasilnya bisa akun.client || akun.teknisi --}}
                            @include('akun.' . $page)
                        @else
                            <form action="{{ url('akun') }}/update" method="POST">

                                <h5 class="my-4">Edit Akun</h5>

                                @csrf
                                @if (request()->detail == 1 && $user->role_id == 0)
                                    @include('akun.form-update-by-admin')
                                @else
                                    @include('akun.form-update-own')
                                @endif
                                <div class="form-group mb-3">
                                    <button class="btn btn-dark">Simpan</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        // remove user
        function removeUser(user_id, name) {
            swal({
                title: `Delete user`,
                text: `Yakin ingin menghapus ${name}?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `{{ url("akun") }}/remove?user_id=${user_id}`,
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success) {
                                swal(`${response.success}`, {
                                    icon: "success",
                                })
                                .then(() => {
                                    location.reload();
                                });
                            }
                        }
                    })
                }
            });
        }
    </script>

    @include('templates.js.change-password')
@endsection
