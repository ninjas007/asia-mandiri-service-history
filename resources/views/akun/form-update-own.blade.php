<div class="form-group mb-3">
    <label for="">Nama</label>
    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
</div>
<div class="form-group mb-3">
    <label for="">Email</label>
    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
</div>
<div class="form-group mb-3">
    <label for="">No HP</label>
    <input type="text" class="form-control" name="no_hp" value="{{ $user->nohp_user }}">
</div>
<div class="form-group mb-3">
    <label for="">Alamat</label>
    <input type="text" class="form-control" name="alamat" value="{{ $user->alamat_user }}">
</div>

@include('templates.form-password')

@if (auth()->user()->role_id != 0)
    <div class="form-group mb-3">
        <label for="">User Terdaftar</label>
        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
    </div>
@endif