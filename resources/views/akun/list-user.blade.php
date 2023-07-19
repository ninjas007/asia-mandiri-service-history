@forelse ($list_user as $user)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="{{ url('akun/detail/'.$user->id.'') }}" class="d-flex align-items-center list-group-item-action mr-5">
            <img src="{{ asset('assets/default-foto.png') }}" alt="" style="width: 45px; height: 45px"
                class="rounded-circle" />
            <div class="ms-3">
                <div class="fw-bold mb-2"><i class="fa fa-user text-dark"></i> {{ $user->name }}</div>
                <div class="text-muted mb-2"><i class="fa fa-pencil text-dark"></i> {{ $user->email }}</div>
                <div class="text-muted mb-0"><i class="fa fa-list text-dark"></i> Total Transaksi: {{ $user->transactions_count }}</div>
            </div>
        </a>
        <div class="pl-3">
            <a href="javascript:void(0)" class="rounded-pill badge-danger p-2 my-1"  data-mdb-toggle="tooltip" title="Hapus user" onclick="removeUser(`{{ $user->id }}`, `{{ $user->name }}`)">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </li>
@empty
@endforelse