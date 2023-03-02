<form action="{{ url('transaksi/save') }}" method="POST" style="padding-bottom: 10rem">
    @csrf
    <input type="hidden" value="{{ $template_service->slug }}" id="slug">
    <input type="hidden" value="{{ $template_service->id }}" name="jenis_service">
    <input type="hidden" value="{{ $client->id }}" name="client_id">

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="judul">Judul Transaksi</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul Transaksi. Misal: Cuci AC">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="merk_type_ac">Merk/Type Ac</label>
                <input type="text" name="merk_type_ac" class="form-control" placeholder="Merk dan Type AC">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="pk">PK</label>
                <input type="text" name="pk" class="form-control" placeholder="Masukkan PK">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="freon">Freon</label>
                <input type="text" name="freon" class="form-control" placeholder="Masukkan Freon">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="ampere">Ampere</label>
                <input type="text" name="ampere" class="form-control" placeholder="Masukkan Ampere">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <table style="width: 100%">
                <tr>
                    <td width="25%">Kompresor</td>
                    <td width="25%">Condensor</td>
                    <td width="25%">Motor Fan</td>
                    <td width="25%">Evoprator</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="kompresor" value="baik" id="kompresorBaik" class="form-check-input">
                            <label for="kompresorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="kompresor" value="buruk" id="kompresorBuruk" class="form-check-input">
                            <label for="kompresorBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="condensor" value="baik" id="condensorBaik" class="form-check-input">
                            <label for="condensorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="condensor" value="buruk" id="condensorBuruk" class="form-check-input">
                            <label for="condensorBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="motor_fan" value="baik" id="motorFanBaik" class="form-check-input">
                            <label for="motorFanBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="motor_fan" value="buruk" id="motorFanBuruk" class="form-check-input">
                            <label for="motorFanBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="evoprator" value="baik" id="evopratorBaik" class="form-check-input">
                            <label for="evopratorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="evoprator" value="buruk" id="evopratorBuruk" class="form-check-input">
                            <label for="evopratorBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <table style="width: 100%">
                <tr>
                    <td width="25%">Motor Blower</td>
                    <td width="25%">Capasitor</td>
                    <td width="25%">Pipa Drainase</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="motor_blower" value="baik" id="motorBlowerBaik" class="form-check-input">
                            <label for="motorBlowerBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="motor_blower" value="buruk" id="motorBlowerBuruk" class="form-check-input">
                            <label for="motorBlowerBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="capasitor" value="baik" id="capasitorBaik" class="form-check-input">
                            <label for="capasitorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="capasitor" value="buruk" id="capasitorBuruk" class="form-check-input">
                            <label for="capasitorBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="pipa_drainase" value="baik" id="pipaDrainaseBaik" class="form-check-input">
                            <label for="pipaDrainaseBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="pipa_drainase" value="buruk" id="pipaDrainaseBuruk" class="form-check-input">
                            <label for="pipaDrainaseBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                        </div>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="kelistrikan">Kelistrikan</label>
                <input type="text" name="kelistrikan" class="form-control">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div>
    </div>

    {{-- <button class="hapus-row"
    onclick="hapusInput(`{{ $template_service->slug }}`, this)">Delete</button>
    <button type="button" id="tambah-input-{{ $template_service->slug }}" onclick="tambahInput(`{{ $template_service->slug }}`)" class="btn btn-primary">
        Tambah Inputan
    </button> --}}
    <div class="row mb-3">
        <div class="col-12">
            <button type="submit" class="btn btn-success form-control">Simpan</button>
        </div>
    </div>
</form>
