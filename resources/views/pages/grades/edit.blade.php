@extends('layouts.app')

@section('title')
    Edit Kelas
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Kelas</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" placeholder="Masukan nama" value="{{ $grade->name }}"
                            class="form-control" @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('grades.index') }}" class="btn btn-secondary">
                        <span class="text">Batal</span>
                    </a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
