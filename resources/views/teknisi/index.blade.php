@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center center-vertical border-0" style="width: 30%">
            <div class="col-12 mb-3">
                <div class="form-group mb-2">
                    <label for="searchClient">Cari Client</label>
                    <input type="text" id="searchClient" class="form-control">
                </div>
                <div class="form-group">
                    <button type="button" id="search" class="btn btn-primary">Search</button>
                    <a href="{{ url('register') }}" class="btn btn-success">Client Baru</a>
                </div>
            </div>

            <div id="wrapClient"></div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('#search').click(function() {
            let search = $('#searchClient').val();

            $.ajax({
                url: `{{ url()->current() }}/search-client`,
                data: {
                    search
                },
                success: function(response) {
                    let tbody = '';

                    $.each(response, function(index, item) {
                        tbody +=
                            `<tr><td style="font-weight: bold"><a href="{{ url('teknisi/client') }}/${item.client_id}">${item.nama}</a> dari User ${item.nama_user}</td></tr>
                        <tr><td>${item.no_hp}</td></tr>
                        <tr><td>${item.alamat}</td></tr>
                        <tr><td><br></td></tr>`
                    })

                    $('#wrapClient').html(`<table>${tbody}</table>`)
                }
            })
        });
    </script>
@endsection
