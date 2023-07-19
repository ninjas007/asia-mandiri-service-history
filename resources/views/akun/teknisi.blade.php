<h5 class="mb-3 mt-5">List Teknisi</h5>
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
<ul class="list-group list-group-light list-user">
	@if (empty($list_user))
		<li class="list-group-item d-flex justify-content-between align-items-center text-center">
			<div class="list-group-item-action mr-5">
				Data tidak ada
			</div>
		</li>
	@else
		@include('akun.list-user')
	@endif
</ul>
