<div class="form-group row mb-2 mt-4">
    <div class="col-md-12">
        {{-- <input type="button" name="password_generate" id="password-generate" class="btn btn-success" value="Generate Password"> --}}
        <a href="javascript:void" class="btn btn-dark" id="password-generate"><i class="fa fa-refresh"></i> Generate Password</a>
    </div>
</div>

<div class="form-group row mb-2">
    <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password') }}</label>

    <div class="col-md-7 input-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        <div class="input-group-append">
            <span class="input-group-text show_pass" data-name="password"><i class="fa fa-eye"></i></span>
        </div>
        
        @error('password')
            <span class="invalid-feedback mt-3" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row mb-2">
    <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

    <div class="col-md-7 input-group">
        <input id="password-confirm" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

        <div class="input-group-append">
            <span class="input-group-text show_pass" data-name="password_confirmation"><i class="fa fa-eye"></i></span>
        </div>
    </div>

    @error('password_confirmation')
        <span class="invalid-feedback mt-3" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>