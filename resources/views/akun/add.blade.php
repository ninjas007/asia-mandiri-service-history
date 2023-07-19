@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Add Akun</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ url('akun/save') }}">
                            @csrf
                            
                            <div class="form-group row mb-2">
                                <label for="role" class="col-md-5 col-form-label text-md-right">Role User</label>
    
                                <div class="col-md-7">

                                    <select name="role" id="role" class="form-control">
                                        <option value="1">Teknisi</option>
                                        <option value="2" @if ($add_client) selected @endif>Client</option>
                                    </select>
    
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="name" class="col-md-5 col-form-label text-md-right">Nama</label>
    
                                <div class="col-md-7">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2 show_client" @if(!$add_client)  style="display: none" @endif>
                                <label for="nama_client" class="col-md-5 col-form-label text-md-right">Nama Client / Toko</label>
    
                                <div class="col-md-7">
                                    <input id="nama_client" type="text" class="form-control @error('nama_client') is-invalid @enderror" name="nama_client" value="{{ old('nama_client') }}" autocomplete="nama_client">
    
                                    @error('nama_client')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="no_hp" class="col-md-5 col-form-label text-md-right">No HP</label>
    
                                <div class="col-md-7">
                                    <input id="no_hp" type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" >
    
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="alamat" class="col-md-5 col-form-label text-md-right">Alamat</label>
    
                                <div class="col-md-7">
                                    <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" >
                                </div>
                            </div>

                            @include('templates.form-password-with-generate')
    
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-dark form-control">
                                        <i class="fa fa-user"></i> {{ __('Register') }}
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

@section('js')
<script type="text/javascript"> 
    $('#role').change(function() {
        let value = $(this).val();

        // teknisi
        if (value == 1) {
            $('.show_client').hide();
        } 
        // client
        else if (value == 2) {
            $('.show_client').show();
        }
    });

</script>
@endsection
