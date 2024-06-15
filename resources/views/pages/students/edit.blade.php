@extends('layouts.app')

@section('title')
    Edit Siswa
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Siswa</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">-- Pilih status --</option>
                            <option value="active" @if ($student->status == 'active') selected @endif>Active</option>
                            <option value="inactive" @if ($student->status == 'inactive') selected @endif>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" placeholder="Masukan nama" value="{{ $student->name }}"
                            class="form-control" @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="place_of_birth" placeholder="Masukan tempat lahir"
                                    value="{{ $student->place_of_birth }}" class="form-control"
                                    @error('place_of_birth') is-invalid @enderror">
                                @error('place_of_birth')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="date_of_birth" placeholder="Masukan tanggal lahir"
                                    value="{{ $student->date_of_birth }}" class="form-control"
                                    @error('date_of_birth') is-invalid @enderror">
                                @error('date_of_birth')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="male" @if ($student->gender == 'male') selected @endif>Laki-laki
                                    </option>
                                    <option value="female" @if ($student->gender == 'female') selected @endif>Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select name="grade_id" class="form-control @error('grade_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            @if ($grade->id == $student->grade_id) selected @endif>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="phone" placeholder="Masukan nomor telepon"
                            value="{{ $student->phone }}" class="form-control" @error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" placeholder="Masukan alamat" class="form-control @error('address') is-invalid @enderror">{{ $student->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="image" value="{{ old('image') }}" class="form-control"
                            @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <span class="text">Batal</span>
                    </a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
