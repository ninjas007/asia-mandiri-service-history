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
                        <div class="row d-flex justify-content-center mb-3">
                            <h5 class="col-md-8">Judul Transaksi: {{ $transaksi->judul }}</h5>
                            <div class="col-md-4">
                                <button class="btn btn-danger float-end remove-transaksi" data-mdb-toggle="tooltip" title="Hapus transaksi">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @foreach ($transaksi_detail as $i => $detail)
                            <div class="py-1">
                                {{-- service ac --}}
                                @if ($detail->transaksi->jenis_service == 1)
                                    @include('services.ac.detail')
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if (auth()->user()->role_id == 1)
                        <div class="card-footer">
                            <div class="list-group list-group-light">
                                <a href="{{ url('teknisi/client?client_id=' . $transaksi->client_id . '&transaksi_id=' . $transaksi->id . '') }}" class="text-primary list-group-item list-group-item-action px-3 border-0 ripple" aria-current="true">
                                   <i class="fa fa-plus"></i> Tambah item baru untuk transaksi ini
                                </a>
                                <a href="{{ url('teknisi/client?client_id=' . $transaksi->client_id) }}" class="text-primary list-group-item list-group-item-action px-3 border-0 ripple" aria-current="true">
                                   <i class="fa fa-plus"></i> Tambah transaksi baru untuk client ini
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        const transaksi_id = `{{ $transaksi->id }}`;

        $('.remove-detail').click(function() {
            let transaksi_detail_id = $(this).data('transaksi_detail_id');
            swal({
                title: `Delete transaksi detail`,
                text: `Yakin ingin menghapus transaksi detail ini?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `{{ url('transaksi-detail') }}/${transaksi_id}/remove`,
                        dataType: 'JSON',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            transaksi_detail_id: transaksi_detail_id
                        },
                        success: function(response) {
                            if (response.message) {
                                swal(`${response.message}`, {
                                    icon: response.status,
                                })
                                .then(() => {
                                    window.location.href = `{{ url('') }}${response.redirect}`;
                                });
                            }
                        }
                    })
                }
            });
        })
      
        $('.remove-transaksi').click(function() {
            swal({
                title: `Delete transaksi`,
                text: `Yakin ingin menghapus transaksi ini?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `{{ url()->current() }}/remove`,
                        dataType: 'JSON',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.message) {
                                swal(`${response.message}`, {
                                    icon: response.status,
                                })
                                .then(() => {
                                    window.location.href = `{{ url('') }}${response.redirect}`;
                                });
                            }
                        }
                    })
                }
            });
        });
    </script>
@endsection
