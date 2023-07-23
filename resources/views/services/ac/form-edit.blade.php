@php
    $detail = json_decode($transaksi_detail->detail);
@endphp
<div class="row mb-3">
    <div class="col-md-12">
        <div class="form-group">
            <label for="deskripsi_service" class="mb-1">Deskripsi Service</label>
            <textarea name="deskripsi_service" id="deskripsiService" cols="30" rows="5" class="form-control tiny">
                {!! json_decode($transaksi_detail->deskripsi_service) !!}
            </textarea>
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
                        <input type="radio" name="kompresor" value="baik" id="kompresorBaik"
                            class="form-check-input" {{ $detail->kompresor == 'baik' ? 'checked' : '' }}>
                        <label for="kompresorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="kompresor" value="buruk" id="kompresorBuruk"
                            class="form-check-input" {{ $detail->kompresor == 'buruk' ? 'checked' : '' }}>
                        <label for="kompresorBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="condensor" value="baik" id="condensorBaik"
                            class="form-check-input" {{ $detail->condensor == 'baik' ? 'checked' : '' }}>
                        <label for="condensorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="condensor" value="buruk" id="condensorBuruk"
                            class="form-check-input" {{ $detail->condensor == 'buruk' ? 'checked' : '' }}>
                        <label for="condensorBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="motor_fan" value="baik" id="motorFanBaik"
                            class="form-check-input" {{ $detail->motor_fan == 'baik' ? 'checked' : '' }}>
                        <label for="motorFanBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="motor_fan" value="buruk" id="motorFanBuruk"
                            class="form-check-input" {{ $detail->motor_fan == 'buruk' ? 'checked' : '' }}>
                        <label for="motorFanBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="evoprator" value="baik" id="evopratorBaik"
                            class="form-check-input" {{ $detail->evoprator == 'baik' ? 'checked' : '' }}>
                        <label for="evopratorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="evoprator" value="buruk" id="evopratorBuruk"
                            class="form-check-input" {{ $detail->kompresor == 'buruk' ? 'checked' : '' }}>
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
                        <input type="radio" name="motor_blower" value="baik" id="motorBlowerBaik"
                            class="form-check-input" {{ $detail->motor_blower == 'baik' ? 'checked' : '' }}>
                        <label for="motorBlowerBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="motor_blower" value="buruk" id="motorBlowerBuruk"
                            class="form-check-input" {{ $detail->motor_blower == 'buruk' ? 'checked' : '' }}>
                        <label for="motorBlowerBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="capasitor" value="baik" id="capasitorBaik"
                            class="form-check-input" {{ $detail->capasitor == 'baik' ? 'checked' : '' }}>
                        <label for="capasitorBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="capasitor" value="buruk" id="capasitorBuruk"
                            class="form-check-input" {{ $detail->capasitor == 'buruk' ? 'checked' : '' }}>
                        <label for="capasitorBuruk" class="form-check-label" style="line-height: 1.8">BURUK</label>
                    </div>
                </td>
                <td>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="pipa_drainase" value="baik" id="pipaDrainaseBaik"
                            class="form-check-input" {{ $detail->pipa_drainase == 'baik' ? 'checked' : '' }}>
                        <label for="pipaDrainaseBaik" class="form-check-label" style="line-height: 1.8">BAIK</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="pipa_drainase" value="buruk" id="pipaDrainaseBuruk"
                            class="form-check-input" {{ $detail->pipa_drainase == 'buruk' ? 'checked' : '' }}>
                        <label for="pipaDrainaseBuruk" class="form-check-label"
                            style="line-height: 1.8">BURUK</label>
                    </div>
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
    </div>
</div>