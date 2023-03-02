@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Cari Client</h4>
                        <div class="form-group mb-3">
                            <label for="searchClient">Masukkan kata kunci</label>
                            <input type="text" id="searchClient" class="form-control"
                                placeholder="Ketik nama user, nama outlet atau alamat outlet"
                                onkeypress="searchInput(this, event)">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url('register') }}" class="btn btn-success">Client Baru</a>
                            <button type="button" onclick="search()" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </div>
                <div id="wrapClient"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function searchInput(elem, e) {
            var charCode;
            if (e && e.which) {
                charCode = e.which;
            } else if (window.event) {
                e = window.event;
                charCode = e.keyCode;
            }

            if (charCode == 13) {
                search();
            }
        }

        function search() {
            let search = $('#searchClient').val();

            $.ajax({
                url: `{{ url()->current() }}/search-client`,
                data: {
                    search
                },
                success: function(response) {
                    let tbody = ``;
                    let wrapClient = ``;

                    if (response.length > 0) {
                        $.each(response, function(index, item) {
                            tbody +=
                                `<tr>
                                    <td style="font-weight: bold; border: .5px solid #bdbdbd; padding: 3px;">
                                        <a href="{{ url('teknisi/client') }}/${item.client_id}">
                                            ${item.nama_user} </br>
                                            ${item.nama} </br>
                                            ${item.no_hp}
                                        </a>
                                    </td>
                                    <td style="border: .5px solid #bdbdbd; padding: 3px; vertical-align: top">${item.alamat}</td>
                                </tr>`
                        })

                        wrapClient = `<div class="card mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                <table border="1" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="border: .5px solid #bdbdbd; padding: 3px;">Client</th>
                                        <th scope="col" style="border: .5px solid #bdbdbd; padding: 3px;">Alamat</th>
                                    </tr>
                                    </thead>
                                    <tbody id="wrapClient">
                                        ${tbody}
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>`;
                    } else {
                        tbody = `<div class="card mt-3">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            Data tidak ditemukan
                                        </div>
                                    </div>
                                </div>`
                    }

                    $('#wrapClient').html(wrapClient)
                }
            })
        }
    </script>
@endsection
