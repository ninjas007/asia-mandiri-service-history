@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 50%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="center-vertical">

                    <div class="card-body px-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3 border">
                                <img src="{{ asset('images/login-picture.png') }}" class="img-fluid" alt="">
                            </div>

                            <div class="form-group text-center">
                                <h5 class="mb-3">LOGIN</h5>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email')}}" required autofocus />
                                <label class="form-label" for="email">{{ __('Email') }}</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                                <label class="form-label" for="password">Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-3 mt-4">
                                <div class="col-md-6 mb-3 d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Password') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-dark btn-block mb-4 fw-bold" style="font-size: 10px">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
