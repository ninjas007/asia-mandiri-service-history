<div class="form-group mb-3">
    <label for="">Nama</label>
    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
</div>
<div class="form-group mb-3">
    <label for="">Email</label>
    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
</div>

@include('templates.form-password')

@if (auth()->user()->role_id != 0)
    <div class="form-group mb-3">
        <label for="">User Terdaftar</label>
        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
    </div>
@endif