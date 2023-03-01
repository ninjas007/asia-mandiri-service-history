@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center center-vertical border-0" style="width: 30%">
            <div class="col-12 mb-3">
                <div class="form-group mb-2">
                    <h5 class="mb-1">Detail Client</h5>
                    @foreach ($client as $item)
                        <ul>
                            <li>{{ $client->nama }}</li>
                            <li>{{ $client->no_hp }}</li>
                            <li>{{ $client->alamat }}</li>
                        </ul>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="service">Pilih Service</label>
                    <select name="service" id="service" class="form-control">
                        <option value="">-- Pilih Service --</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="wrapService"></div>
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
