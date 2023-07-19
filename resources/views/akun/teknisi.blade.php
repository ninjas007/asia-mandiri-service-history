<h5 class="mb-3 mt-5">Daftar Teknisi</h5>
<div class="input-group mb-3">
    <div class="form-outline">
        <input id="search-input" type="search" id="form1" class="form-control"
            placeholder="Cari teknisi berdasarkan nama, email, atau no hp" />
        <label class="form-label" for="form1">Cari Teknisi</label>
    </div>
    <button id="search-button" type="button" class="btn btn-success">
        <i class="fas fa-search"></i>
    </button>
</div>
<ul class="list-group list-group-light">
	@forelse ($list_user as $teknisi)
		<li class="list-group-item d-flex justify-content-between align-items-center">
			<a href="{{ url('akun/detail/'.$teknisi->id.'') }}" class="d-flex align-items-center list-group-item-action mr-5">
				<img src="{{ asset('assets/default-foto.png') }}" alt="" style="width: 45px; height: 45px"
					class="rounded-circle" />
				<div class="ms-3">
					<div class="fw-bold mb-2"><i class="fa fa-user text-dark"></i> {{ $teknisi->name }}</div>
					<div class="text-muted mb-2"><i class="fa fa-pencil text-dark"></i> {{ $teknisi->email }}</div>
					<div class="text-muted mb-0"><i class="fa fa-list text-dark"></i> Total Transaksi: {{ $teknisi->transactions_count }}</div>
				</div>
			</a>
			<div class="pl-3">
				<a href="javascript:void(0)" class="rounded-pill badge-danger p-2 my-1"  data-mdb-toggle="tooltip" title="Hapus teknisi" onclick="removeUser(`{{ $teknisi->id }}`, `{{ $teknisi->name }}`)">
					<i class="fa fa-trash"></i>
				</a>
			</div>
		</li>
	@empty
	<li class="list-group-item d-flex justify-content-between align-items-center text-center">
		<div class="list-group-item-action mr-5">
			Data tidak ada
		</div>
	</li>
	@endforelse
</ul>
