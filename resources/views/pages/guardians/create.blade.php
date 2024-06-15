@extends('layouts.app')

@section('title')
    Buat Wali
@endsection

@push('extra-style')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Buat Wali</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <form action="{{ route('guardians.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Siswa</label>
                        <select name="student_id" id="basic-usage"
                            class="form-control @error('student_id') is-invalid @enderror">
                            <option value="">-- Pilih siswa --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" @if (old('student_id') == $student->id) selected @endif>
                                    {{ $student->name }}</option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="id_number" placeholder="Masukan NIK" value="{{ old('id_number') }}"
                            class="form-control" @error('id_number') is-invalid @enderror">
                        @error('id_number')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
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
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Masukan email" value="{{ old('email') }}"
                                    class="form-control" @error('email') is-invalid @enderror">
                                @error('email')
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
                                    <option value="male" @if (old('gender') == 'male') selected @endif>Laki-laki
                                    </option>
                                    <option value="female" @if (old('gender') == 'female') selected @endif>Perempuan
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
                                <label>Hubungan</label>
                                <input type="text" name="relationship" placeholder="Masukan hubungan"
                                    value="{{ old('relationship') }}" class="form-control"
                                    @error('relationship') is-invalid @enderror">
                                @error('relationship')
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
                                <label>Pekerjaan</label>
                                <input type="text" name="job" placeholder="Masukan pekerjaan"
                                    value="{{ old('job') }}" class="form-control" @error('job') is-invalid @enderror">
                                @error('job')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" name="phone" placeholder="Masukan telepon"
                                    value="{{ old('phone') }}" class="form-control"
                                    @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" placeholder="Masukan alamat" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
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
                    <a href="{{ route('guardians.index') }}" class="btn btn-secondary">
                        <span class="text">Cancel</span>
                    </a>
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('extra-script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

    <script>
        $('#basic-usage').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endpush
