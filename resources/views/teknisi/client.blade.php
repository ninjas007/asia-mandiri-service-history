@extends('layouts.app')

@section('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            @include('templates.detail-client')

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pilih Service</h5>
                </div>
                <div class="list-group list-group-light">
                    @php
                        $url = url('teknisi/service').'?client_id='.$client->id;

                        if (request()->get('transaksi_id')) {
                            $url .= '&transaksi_id='.request()->get('transaksi_id');
                        }
                    @endphp
                    @foreach ($services as $service)
                        <a href="{{ $url }}&service_id={{ $service->id }}" class="list-group-item text-primary list-group-item-action px-3 border-0 ripple"
                        aria-current="true">
                        {{ $service->nama_layanan }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.tiny.cloud/1/fioab1f7iscuty6onrm6ezlq795cnlvwjy81btkvag3piuoj/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
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
                    loadTinymce();
                    loadFilePond();
                }
            })
        }

        $('#service').change(function() {
            let service_id = $(this).val();
            let client_id = `{{ $client->id }}`;
            let transaksi_id = `{{ request()->get('transaksi_id') }}`;

            pilihService(service_id, client_id, transaksi_id);
        })

        function loadTinymce() {
            tinymce.init({
                selector: 'textarea.tiny',
                forced_root_block: 'div'
            });
        }

        function loadFilePond() {
            const uniq_string = generateRandomString();
            
            // isi inputan uniq_string untuk proses simpan ke folder images saat save transaksi
            $('#uniq_string').val(uniq_string);


            // prsose upload
            $('#images').filepond({
                onaddfile: async (error, file) => {
                    await sendFile(file, uniq_string);
                },
                onremovefile: async (errror, file) => {
                    await removeFile(file.id);
                },
                allowMultiple: true,
            })
        }

        async function sendFile(file, uniq_string) {
            const formData = new FormData();

            formData.append('images', file.file);
            formData.append('uniq_string', uniq_string);
            formData.append('file_id', file.id);

            await $.ajax({
                url: '/tmp-upload',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processData: false,
                contentType: false
            });
        }

        async function removeFile(file_id) {
            $.ajax({
                url: `/tmp-delete?file_id=${file_id}`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                }
            })
        }

        function generateRandomString() {
            const timestamp = new Date().getTime();
            const randomString = Math.random().toString(36).substring(2);
            const randomStringWithTimestamp = randomString + timestamp;

            return randomStringWithTimestamp;
        }
    </script>
@endsection
