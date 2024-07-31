@extends('layouts.app')

@section('title')
    Detail Siswa
@endsection

@push('extra-style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Siswa</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detail Siswa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($student->status == 'active')
                                    <span class="badge badge-success">{{ $student->status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $student->status }}</span>
                                @endif
                            </td>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $student->grade->name }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $student->place_of_birth }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $student->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $student->gender }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $student->address }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>{{ $student->phone }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if ($student->image)
                                    <img src="{{ $student->image_url }}" alt="{{ $student->name }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Wali {{ $student->name }}</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Hubungan</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->relationship }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('extra-script')
    <!-- Page level plugins -->
    <script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('dist/js/demo/datatables-demo.js') }}"></script>
@endpush
