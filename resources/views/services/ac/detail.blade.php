@php
    $json_detail = json_decode($detail->detail, true);
@endphp

<ul class="list-group list-group-flush">
    <a data-mdb-toggle="collapse" href="#collapseExample{{ $i + 1 }}" role="button" aria-expanded="false"
        aria-controls="collapseExample{{ $i + 1 }}">
        <li class="list-group-item px-0">
            <div class="text-center">
                <b>Detail Item {{ $i + 1 }}</b>
            </div>

            <div class="collapse" id="collapseExample{{ $i + 1 }}">
                <hr>
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
        </li>
    </a>
</ul>

{{-- @foreach ($json_detail as $key => $val)
    <li>{{ $key }} : {{ $val }}</li>
@endforeach --}}
