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
                        @if ($transaksi->getAttrLatestHistoryAttribute()->transaksi_status_id == 1)
                            <span class="badge badge-warning mb-1">PENGERJAAN</span>
                        @elseif ($transaksi->getAttrLatestHistoryAttribute()->transaksi_status_id == 2)
                            <span class="badge badge-success mb-1">SELESAI</span>
                        @endif
                        <div class="row d-flex justify-content-center mb-3">
                            <h5 class="col-md-8">Judul Transaksi: {{ $transaksi->judul }}</h5>
                            <div class="col-md-4">
                                <button class="btn btn-danger float-end remove-transaksi" data-mdb-toggle="tooltip"
                                    title="Hapus transaksi">
                                    <i class="fa fa-trash"></i>
                                </button>
                                @if (auth()->user()->role_id == 0 || auth()->user()->role_id == 1)
                                    <button class="btn btn-primary float-end edit-transaksi" data-mdb-toggle="tooltip"
                                        title="Edit transaksi" style="margin-right: 5px">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                @endif
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
                    {{-- cuman teknisi yang bisa add transaksi --}}
                    @if (auth()->user()->role_id == 1)
                        <div class="card-footer">
                            <div class="list-group list-group-light">
                                <a href="{{ url('teknisi/client?client_id=' . $transaksi->client_id . '&transaksi_id=' . $transaksi->id . '') }}"
                                    class="text-primary list-group-item list-group-item-action px-3 border-0 ripple"
                                    aria-current="true">
                                    <i class="fa fa-plus"></i> Tambah item baru untuk transaksi ini
                                </a>
                                <a href="{{ url('teknisi/client?client_id=' . $transaksi->client_id) }}"
                                    class="text-primary list-group-item list-group-item-action px-3 border-0 ripple"
                                    aria-current="true">
                                    <i class="fa fa-plus"></i> Tambah transaksi baru untuk client ini
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('transaksi') }}/update/{{ $transaksi->id }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Transaksi</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="judul" class="mb-2">Judul Transaksi</label>
                            <input type="text" class="form-control" name="judul" id="judul"
                                value="{{ $transaksi->judul }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status" class="mb-2">Status Transaksi</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $transaksi->getAttrLatestHistoryAttribute()->transaksi_status_id == 1 ? 'selected' : '' }}>PENGERJAAN</option>
                                <option value="2" {{ $transaksi->getAttrLatestHistoryAttribute()->transaksi_status_id == 2 ? 'selected' : '' }} >SELESAI</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

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
                            url: `{{ url('transaksi-detail') }}/remove/${transaksi_detail_id}`,
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
                                            window.location.href =
                                                `{{ url('') }}${response.redirect}`;
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
                            url: `{{ url('transaksi') }}/remove/${transaksi_id}`,
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
                                            window.location.href =
                                                `{{ url('') }}${response.redirect}`;
                                        });
                                }
                            }
                        })
                    }
                });
        });

        $('.edit-transaksi').click(function() {
            $('#modalEdit').modal('show')
        });
    </script>
@endsection
