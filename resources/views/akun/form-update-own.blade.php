<div class="form-group mb-3">
    <label for="">Nama</label>
    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
</div>
<div class="form-group mb-3">
    <label for="">Email</label>
    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
</div>
<div class="form-group mb-3">
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
</div>
@if (auth()->user()->role_id != 0)
    <div class="form-group mb-3">
        <label for="">User Terdaftar</label>
        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
    </div>
@endif