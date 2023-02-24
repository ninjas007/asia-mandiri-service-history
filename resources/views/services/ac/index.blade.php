<form action="{{ url('transaksi/save') }}" method="POST">
    @csrf
    <br>
    <label for="">Judul Transaksi</label>
    <input type="text" name="judul" placeholder="Judul">
    <br>
    <button type="button" id="tambah-input-{{ $template_service->slug }}"
        onclick="tambahInput(`{{ $template_service->slug }}`)">Tambah
        Inputan</button>
    <input type="hidden" value="{{ $template_service->slug }}" id="slug">
    <input type="hidden" value="{{ $template_service->id }}" name="jenis_service">
    <input type="hidden" value="{{ $client->id }}" name="client_id">
    <table style="width: 100%" border="1" id="table-{{ $template_service->slug }}">
        <thead>
            <tr>
                <td rowspan="2" style="width: 5%">NO</td>
                <td rowspan="2" style="width: 5%">Merk/Type Ac</td>
                <td rowspan="2" style="width: 5%">PK</td>
                <td rowspan="2" style="width: 5%">Freon</td>
                <td rowspan="2" style="width: 5%">Ampere</td>
                <td colspan="2" style="width: 5%">Kompresor</td>
                <td colspan="2" style="width: 5%">Condensor</td>
                <td colspan="2" style="width: 5%">Motor Fan</td>
                <td colspan="2" style="width: 5%">Evoprator</td>
                <td colspan="2" style="width: 5%">Motor Blower</td>
                <td colspan="2" style="width: 5%">Capasitor</td>
                <td colspan="2" style="width: 5%">Pipa Drainase</td>
                <td rowspan="2" style="width: 5%">Kelistrikan</td>
                <td rowspan="2" style="width: 5%">Keterangan</td>
                <td rowspan="2" style="width: 5%">Action</td>
            </tr>

            <tr>
                <td style="width: 5%">BAIK</td>
                <td style="width: 5%">BURUK</td>
                <td style="width: 5%">BAIK</td>
                <td style="width: 5%">BURUK</td>
                <td style="width: 5%">BAIK</td>
                <td style="width: 5%">BURUK</td>
                <td style="width: 5%">BAIK</td>
                <td style="width: 5%">BURUK</td>
                <td style="width: 5%">BAIK</td>
                <td style="width: 5%">BURUK</td>
                <td style="width: 5%">BAIK</td>
                <td style="width: 5%">BURUK</td>
                <td style="width: 5%">BAIK</td>
                <td style="width: 5%">BURUK</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><input type="text" name="merk_type_ac[baik]"></td>
                <td><input type="text" name="pk[baik]"></td>
                <td><input type="text" name="freon[baik]"></td>
                <td><input type="text" name="ampere[baik]"></td>
                <td><input type="radio" name="kompresor[baik]"></td>
                <td><input type="radio" name="kompresor[baik]"></td>
                <td><input type="radio" name="condensor[baik]"></td>
                <td><input type="radio" name="condensor[baik]"></td>
                <td><input type="radio" name="motor_fan[baik]"></td>
                <td><input type="radio" name="motor_fan[baik]"></td>
                <td><input type="radio" name="evoprator[baik]"></td>
                <td><input type="radio" name="evoprator[baik]"></td>
                <td><input type="radio" name="motor_blower[baik]"></td>
                <td><input type="radio" name="motor_blower[baik]"></td>
                <td><input type="radio" name="capasitor[baik]"></td>
                <td><input type="radio" name="capasitor[baik]"></td>
                <td><input type="radio" name="pipa_drainase[baik]"></td>
                <td><input type="radio" name="pipa_drainase[baik]"></td>
                <td><input type="text" name="kelistrikan[baik]"></td>
                <td>
                    <textarea name="keterangan[baik]"></textarea>
                </td>
                <td style="text-align: center">
                    <button class="hapus-row"
                        onclick="hapusInput(`{{ $template_service->slug }}`, this)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
    <button type="submit">Simpan</button>
</form>
