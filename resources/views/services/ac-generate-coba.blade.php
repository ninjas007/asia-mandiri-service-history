<br>
<button>Tambah Inputan</button>
<table style="width: 100%">
    <tr>
        @php
            $length_parent = 0;
        @endphp
        @foreach ($forms as $form)
            @if ($form->is_parent == 0)
                <td style="text-transform: capitalize" rowspan="2">{{ str_replace('_', ' ', $form->name) }}</td>
            @else
                @php
                    $length_parent++;
                @endphp
                <td style="text-transform: capitalize" colspan="2">{{ str_replace('_', ' ', $form->name) }}</td>
            @endif
        @endforeach
    </tr>

    <tr>
        @for ($i = 0; $i < $length_parent; $i++)
            <td>BAIK</td>
            <td>BURUK</td>
        @endfor
    </tr>

    <tr>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="radio" name="kompresor"></td>
        <td><input type="radio" name="kompresor"></td>
        <td><input type="radio" name="condensor"></td>
        <td><input type="radio" name="condensor"></td>
        <td><input type="radio" name="motor_fan"></td>
        <td><input type="radio" name="motor_fan"></td>
        <td><input type="radio" name="evoprator"></td>
        <td><input type="radio" name="evoprator"></td>
        <td><input type="radio" name="motor_blower"></td>
        <td><input type="radio" name="motor_blower"></td>
        <td><input type="radio" name="capasitor"></td>
        <td><input type="radio" name="capasitor"></td>
        <td><input type="radio" name="pipa_drainase"></td>
        <td><input type="radio" name="pipa_drainase"></td>
        <td><input type="text" name="kelistrikan"></td>
        <td><textarea name="keterangan"></textarea></td>
        <td style="text-align: center">
            <button>Delete</button>
        </td>
    </tr>
</table>

