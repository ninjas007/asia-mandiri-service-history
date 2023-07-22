@php
    $json_detail = json_decode($detail->detail, true);
    $photos = json_decode($detail->photos, true);
    $deskripsi_service = json_decode($detail->deskripsi_service);
@endphp

<div class="text-center bg-dark text-white my-1 border py-2" data-mdb-toggle="collapse" href="#collapseExample{{ $i }}"
    role="button" aria-expanded="false" aria-controls="collapseExample{{ $i }}">
    <b>Detail Item - {{ $i + 1 }}</b>
</div>

<div class="collapse my-3" id="collapseExample{{ $i }}">
    <table style="width: 100%">
        @foreach ($json_detail as $key => $item)
            <tr>
                <td width="25%" style="text-transform: capitalize; padding: 3px; vertical-align: top;">{{ str_replace('_', ' ', $key) }}</td>
                <td width="2%" style=" vertical-align: top; padding: 3px;">:</td>
                <td width="73%" style=" vertical-align: top; padding: 3px;">{{ $item }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">
                {!! $deskripsi_service !!}
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="margin-left: 5px">
                    <div class="mb-3" >Foto: </div>
                    @foreach ($photos as $key => $photo)
                        <img src="{{ url('/transaction').'/'.$photo['file_name'] }}" alt="" width="100" st>
                    @endforeach
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">
                <button class="btn btn-danger float-end remove-detail" data-mdb-toggle="tooltip" title="Hapus detail transaksi" data-transaksi_detail_id="{{ $detail->id }}">
                    <i class="fa fa-trash"></i> Hapus Detail
                </button>
                <button class="btn btn-primary float-end me-3" data-mdb-toggle="tooltip" title="Edit detail transaksi">
                    <i class="fa fa-pencil"></i> Edit Detail
                </button>
            </td>
        </tr>
    </table>
</div>