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
                        <li>{{ $client->nama }}</li>
                        <li>{{ $client->no_hp }}</li>
                        <li>{{ $client->alamat }}</li>
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
                const index = $(`#table-${slug} tbody tr`).length;
                const html = `<tr>
                    <td id="no">${no}</td>
                    <td><input type="text" name="merk_type_ac[${index}]"></td>
                    <td><input type="text" name="pk[${index}]"></td>
                    <td><input type="text" name="freon[${index}]"></td>
                    <td><input type="text" name="ampere[${index}]"></td>
                    <td><input type="radio" name="kompresor[${index}]"></td>
                    <td><input type="radio" name="kompresor[${index}]"></td>
                    <td><input type="radio" name="condensor[${index}]"></td>
                    <td><input type="radio" name="condensor[${index}]"></td>
                    <td><input type="radio" name="motor_fan[${index}]"></td>
                    <td><input type="radio" name="motor_fan[${index}]"></td>
                    <td><input type="radio" name="evoprator[${index}]"></td>
                    <td><input type="radio" name="evoprator[${index}]"></td>
                    <td><input type="radio" name="motor_blower[${index}]"></td>
                    <td><input type="radio" name="motor_blower[${index}]"></td>
                    <td><input type="radio" name="capasitor[${index}]"></td>
                    <td><input type="radio" name="capasitor[${index}]"></td>
                    <td><input type="radio" name="pipa_drainase[${index}]"></td>
                    <td><input type="radio" name="pipa_drainase[${index}]"></td>
                    <td><input type="text" name="kelistrikan[${index}]"></td>
                    <td>
                        <textarea name="keterangan[${index}]"></textarea>
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
