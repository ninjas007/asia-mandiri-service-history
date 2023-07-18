<div class="form-group mb-3 mt-3">
    <input type="checkbox" id="change-password" name="change_password"> 
    <label for="change-password">Change password</label>
</div>
<div id="wrap-password" style="display: none">
    @if (!isset($by_admin))
        <div class="form-group mb-3">
            <label for="">Password Lama</label>
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                <div class="input-group-append">
                    <span class="input-group-text show_pass" data-name="password"><i class="fa fa-eye"></i></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endif
    <div class="form-group mb-3">
        <label for="password-confirm" class="text-md-right">Password Baru</label>

        <div class="col-md-7 input-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

            <div class="input-group-append">
                <span class="input-group-text show_pass" data-name="password_confirmation"><i class="fa fa-eye"></i></span>
            </div>
        </div>

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>