@php
    $url = url('');
    if (auth()->user()->role_id == 1) {
        $url = url('teknisi');
    }
@endphp
<nav class="navbar-wrap">
    <div class="menubar-footer">
        <a href="{{ url('/') }}">
            <button class="btn-menubar">
                <i class="fa fa-home" style="width: 24px; height: 24px; color: #5f5f5f; font-size: 20px"></i>
                <span style="color: #5f5f5f; font-size: 10px">Home</span>
            </button>
        </a>
        <a href="{{ url('transaksi') }}">
            <button class="btn-menubar">
                <i class="fa fa-list" style="width: 24px; height: 24px; color: #5f5f5f; font-size: 20px"></i>
                <span style="color: #5f5f5f; font-size: 10px"> @if(auth()->user()->role_id == 0) Transactions @else My Transaction @endif</span>
            </button>
        </a>
        {{-- @if (auth()->user()->role_id == 0)
            <a href="{{ url('client') }}">
                <button class="btn-menubar">
                    <i class="fa fa-users" style="width: 24px; height: 24px; color: #5f5f5f; font-size: 20px"></i>
                    <span style="color: #5f5f5f; font-size: 10px">Clients</span>
                </button>
            </a>
        @endif --}}
        <a href="{{ url('akun') }}">
            <button class="btn-menubar">
                <i class="fa fa-user" style="width: 24px; height: 24px; color: #5f5f5f; font-size: 20px"></i>
                <span style="color: #5f5f5f; font-size: 10px">
                    @if (auth()->user()->role_id == 0)
                        Accounts
                    @else
                        Account
                    @endif
                </span>
            </button>
        </a>
        <a href="{{ route('logout') }}">
            <button class="btn-menubar">
                <i class="fa fa-sign-out" style="width: 24px; height: 24px; color: #5f5f5f; font-size: 20px"></i>
                <span style="color: #5f5f5f; font-size: 10px">Logout</span>
            </button>
        </a>
    </div>
</nav>
