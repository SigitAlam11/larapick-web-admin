@extends('layouts.app')

@section('title')
    Buat Admin
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Buat Admin</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" placeholder="Masukan nama" value="{{ old('name') }}"
                            class="form-control" @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Masukan email" value="{{ old('email') }}"
                            class="form-control" @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <span class="text">Batal</span>
                    </a>
                    <button class="btn btn-primary" type="submit">Buat</button>
                </div>
            </form>
        </div>
    </div>
@endsection
