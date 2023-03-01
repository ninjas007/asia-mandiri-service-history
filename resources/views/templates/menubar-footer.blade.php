<div style="z-index: 99; position: fixed; bottom: 0; left: 33.15%; right: 33.15%; display: flex; justify-content: space-evenly; border-top: .1px solid #3e3e3e"
    class=" text-center">
    @php
        /*
        * 0 = admin, 1 = teknisi, 2 = client
        */
        if (auth()->user()->role_id == 0) {
            $url = url('');
        } else if (auth()->user()->role_id == 1) {
            $url = url('teknisi');
        } else if (auth()->user()->role_id == 1) {
            $url = url('');
        }
    @endphp
    <a href="{{ $url }}" style="padding: 10px;">Home</a>
    <a href="" style="padding: 10px">Transaksi</a>
    <a href="" style="padding: 10px">Account</a>
    <a href="{{ route('logout') }}" style="padding: 10px">Logout</a>
</div>
