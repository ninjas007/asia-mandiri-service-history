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
                        <ul>
                            <li>{{ $client->nama }}</li>
                            <li>{{ $client->no_hp }}</li>
                            <li>{{ $client->alamat }}</li>
                        </ul>
                        <br>
                        <label for="service">Pilih Service</label>
                        <br>
                        <select name="service" id="service">
                            <option value="">-- Pilih Service --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->nama_layanan }}</option>
                            @endforeach
                        </select>
                        <br>

                        <div id="wrapService"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function pilihService(service_id) {
            $.ajax({
                url: `{{ url()->current() }}/${service_id}`,
                dataType: `html`,
                success: function(res) {
                    $('#wrapService').html(res)
                }
            })
        }

        function tambahInput(slug) {
            if (slug == 'service-ac') {
                const no = $(`#table-${slug} tbody tr`).length + 1;
                const html = `<tr>
                    <td id="no">${no}</td>
                    <td><input type="text" name="merk_type_ac[]"></td>
                    <td><input type="text" name="pk[]"></td>
                    <td><input type="text" name="freon[]"></td>
                    <td><input type="text" name="ampere[]"></td>
                    <td><input type="radio" name="kompresor[]"></td>
                    <td><input type="radio" name="kompresor[]"></td>
                    <td><input type="radio" name="condensor[]"></td>
                    <td><input type="radio" name="condensor[]"></td>
                    <td><input type="radio" name="motor_fan[]"></td>
                    <td><input type="radio" name="motor_fan[]"></td>
                    <td><input type="radio" name="evoprator[]"></td>
                    <td><input type="radio" name="evoprator[]"></td>
                    <td><input type="radio" name="motor_blower[]"></td>
                    <td><input type="radio" name="motor_blower[]"></td>
                    <td><input type="radio" name="capasitor[]"></td>
                    <td><input type="radio" name="capasitor[]"></td>
                    <td><input type="radio" name="pipa_drainase[]"></td>
                    <td><input type="radio" name="pipa_drainase[]"></td>
                    <td><input type="text" name="kelistrikan[]"></td>
                    <td>
                        <textarea name="keterangan[]"></textarea>
                    </td>
                    <td style="text-align: center">
                        <button type="button" class="hapus-row" onclick="hapusInput('${slug}', this)">Delete</button>
                    </td>
                </tr>`
                $(`#table-${slug} tbody`).append(html);
            }
        }

        function hapusInput(slug, e) {
            if (slug == 'service-ac') {
                $(e).parent().parent().remove()
            }
        }

        $('#service').change(function() {
            let service_id = $(this).val();
            pilihService(service_id);
        })
    </script>
@endsection
