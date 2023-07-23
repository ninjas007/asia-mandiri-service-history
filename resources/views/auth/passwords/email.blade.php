@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 50%">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="center-vertical">
                <div class="card-body px-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-3 border">
                            <img src="{{ asset('images/login-picture.png') }}" class="img-fluid" alt="">
                        </div>

                        <div class="form-group text-center">
                            <h5 class="mb-3">{{ __('Reset Password') }}</h5>
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

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-dark form-control fw-bold" style="font-size: 10px">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
