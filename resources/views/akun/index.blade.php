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
                    @if (isset($list_user) && $list_user->isNotEmpty() && isset($total_user) && $total_user > $limit)
                        <div class="card-footer bg-dark text-center text-white" id="load-more" onclick="loadMore()">
                            <i class="fa fa-refresh"></i> Lihat Lainnya
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var offset = `{{ $limit }}`; // untuk inisalisasi saja
        const role_id = `{{ $role_id ?? null }}`;
        const filter = `{{ $filter }}`;

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

        function loadMore() {
            let element = $('#load-more');
            let total_user = role_id == 1 ? $('#total-teknisi').text() : $('#total-client').text();

            $.ajax({
                url: `{{ url('akun')}}/load-more`,
                dataType: 'JSON',
                data: {
                    role_id,
                    offset,
                },
                beforeSend: function() {
                    element.html('<i class="fa fa-spinner"></i> Loading')
                },
                success: function(response) {
                    offset = parseInt(response.data.offset) + parseInt(offset);

                    $('.list-user').append(response.data.html)

                    if (offset >= total_user) {
                        element.remove();
                    }
                    
                    element.html('<i class="fa fa-refresh"></i> Lihat Lainnya')
                }
            })
        }

        function searchUser() {
            let element = $('#cari-user');
            let filter = element.val();

            window.location.href = `{{ url()->current() }}?search_role=${role_id}&filter=${filter}`;
        }

        function onKeySearchUser() {
            let element = $('#cari-user');

            // jika dari filter dan search di inputannya kosong agar refresh halaman
            if (filter && element.val() == "") {
                window.location.href = `{{ url()->current() }}`
            }
        }
    </script>

    @include('templates.js.change-password')
@endsection
