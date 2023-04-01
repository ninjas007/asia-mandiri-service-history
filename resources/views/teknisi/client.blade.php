@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card mb-2">
                <div class="card-header">
                    <h5>Detail Client</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li>{{ $client->nama_user }}</li>
                        <li>{{ $client->nohp_user }}</li>
                        <li>{{ $client->alamat_user }}</li>
                    </ul>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="service">Pilih Service</label>
                        <select name="service" id="service" class="form-control">
                            <option value="">-- Pilih Service --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->nama_layanan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="wrapService"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function pilihService(service_id, client_id, transaksi_id) {
            $.ajax({
                url: `{{ url('teknisi/client/search-service') }}`,
                data: {
                    client_id,
                    service_id,
                    transaksi_id
                },
                dataType: `html`,
                success: function(res) {
                    $('#wrapService').html(res)
                }
            })
        }

        $('#service').change(function() {
            let service_id = $(this).val();
            let client_id = `{{ $client->id }}`;
            let transaksi_id = `{{ request()->get('transaksi_id') }}`;

            pilihService(service_id, client_id, transaksi_id);
        })
    </script>
@endsection
