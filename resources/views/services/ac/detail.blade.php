@php
    $json_detail = json_decode($detail->detail, true);
@endphp

<div class="text-center my-1 border py-2" data-mdb-toggle="collapse" href="#collapseExample{{ $i }}"
    role="button" aria-expanded="false" aria-controls="collapseExample{{ $i }}">
    <b>Detail Item - {{ $i + 1 }}</b>
</div>

<div class="collapse my-3" id="collapseExample{{ $i }}">
    <table style="width: 100%">
        @foreach ($json_detail as $key => $item)
            <tr>
                <td width="25%" style="text-transform: capitalize; padding-left: 5px; vertical-align: top">{{ str_replace('_', ' ', $key) }}</td>
                <td width="2%" style=" vertical-align: top">:</td>
                @if ($key != 'foto')
                    <td width="73%" style=" vertical-align: top">{{ $item }}</td>
                @else
                    <td width="73%" style=" vertical-align: top">
                        @foreach ($item as $nama_foto => $foto)
                            <label for=""></label>
                            <table width="100%">
                                <tr>
                                    <td style="text-transform: capitalize">
                                        {{ str_replace('_', ' ', $nama_foto) }} <br>
                                        <img src="{{ url('') }}/images/{{ $foto }}" alt="" width="100">
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach

    </table>
</div>