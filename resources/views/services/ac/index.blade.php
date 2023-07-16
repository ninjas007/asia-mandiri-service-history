@extends('layouts.app')

@section('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section('content')
    <form action="{{ url('transaksi/save') }}" method="POST" style="padding-bottom: 5rem" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $template_service->slug }}" id="slug">
        <input type="hidden" value="{{ $template_service->id }}" name="jenis_service">
        <input type="hidden" value="{{ $client->id }}" name="client_id">
        <input type="hidden" value="{{ request()->get('transaksi_id') }}" name="transaksi_id">
        <input type="hidden" value="" name="uniq_string" id="uniq_string">

        <div class="row mb-3">
            <div class="col-md-12">
                @include('templates.detail-client')
            </div>
        </div>

        <div class="card p-3">
            <div class="row mb-3 {{ request()->get('transaksi_id') ? 'd-none' : '' }}">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="judul" class="mb-1">Judul Transaksi</label>
                        <input type="text" name="judul" class="form-control" placeholder="Judul Transaksi. Misal: Cuci AC" value="">
                    </div>
                </div>
            </div>

            @include('services.ac.form')

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="images" class="mb-3">Upload Foto</label>
                        <input id="images" type="file" multipledata-allow-reorder="true"
                            data-max-file-size="3MB">
                    </div>
                </div>
            </div>

            <div class="row mb-3 mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-success form-control">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://cdn.tiny.cloud/1/fioab1f7iscuty6onrm6ezlq795cnlvwjy81btkvag3piuoj/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script type="text/javascript">
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

        loadTinymce();
        loadFilePond();
    </script>
@endsection
