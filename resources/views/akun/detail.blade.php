@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 100%; padding-bottom: 80px">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Akun</h5>
                    <div class="card-body">
                        <form action="{{ url('akun') }}/update" method="POST">

                            <h5 class="my-4">Edit Akun by Admin</h5>

                            @csrf
                            @include('akun.form-update-by-admin', ['by_admin' => true])

                            <div class="form-group mb-3">
                                <button class="btn btn-dark">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('templates.js.change-password')
@endsection