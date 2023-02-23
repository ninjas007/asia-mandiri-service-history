@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="margin-bottom: 5px">Halaman Teknisi</div>

                <div class="card-body">
                    <label for="">Client</label>
                    <br>
                    <input type="text" id="searchClient">
                    <br>
                    <button type="button" id="search">Search</button>

                    <div id="wrapClient"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#search').click(function() {
        let search = $('#searchClient').val();

        $.ajax({
            url: `{{ url()->current() }}/search-client`,
            data: {search},
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
