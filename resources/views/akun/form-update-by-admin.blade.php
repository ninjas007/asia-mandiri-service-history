<input type="hidden" name="update_by_admin" value="1">
<input type="hidden" name="user_id" value="{{ request()->user_id }}">

<div class="form-group row mb-2">
    <label for="name" class="col-md-5 col-form-label text-md-right">Username</label>

    <div class="col-md-7">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row mb-2">
    <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('Email') }}</label>

    <div class="col-md-7">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@if ($user->role_id == 2)
    <div class="form-group row mb-2">
        <label for="nama_client" class="col-md-5 col-form-label text-md-right">Nama Client / Toko</label>

        <div class="col-md-7">
            <input id="nama_client" type="text" class="form-control @error('nama_client') is-invalid @enderror" name="nama_client" value="{{ $user->nama }}" autocomplete="nama_client">

            @error('nama_client')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
@endif

<div class="form-group row mb-2">
    <label for="no_hp" class="col-md-5 col-form-label text-md-right">No HP</label>

    <div class="col-md-7">
        <input id="no_hp" type="text" class="form-control" name="no_hp" value="{{ $user->nohp_user }}">
    </div>
</div>

<div class="form-group row mb-2">
    <label for="alamat" class="col-md-5 col-form-label text-md-right">Alamat</label>

    <div class="col-md-7">
        <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $user->alamat_user }}" >
    </div>
</div>
{{-- <div class="form-group mb-3">
    <label for="">Password Lama</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control password_lama" placeholder="Password lama"
            name="password_lama">
        <div class="input-group-append">
            <span class="input-group-text show_pass" data-name="password_lama"><i
                    class="fa fa-eye"></i></span>
        </div>
    </div>
</div>
<div class="form-group mb-3">
    <label for="">Password Baru</label>
    <div class="input-group mb-3">
        <input type="password" class="form-control password_baru" placeholder="Password baru"
            name="password_baru">
        <div class="input-group-append">
            <span class="input-group-text show_pass" data-name="password_baru"><i
                    class="fa fa-eye"></i></span>
        </div>
    </div>
</div> --}}