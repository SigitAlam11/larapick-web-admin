@extends('layouts.app')

@section('title')
    Detail Wali
@endsection

@push('extra-style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Wali</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detail Wali</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $guardian->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $guardian->email }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $guardian->id_number }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $guardian->gender }}</td>
                        </tr>
                        <tr>
                            <th>Hubungan</th>
                            <td>{{ $guardian->relationship }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $guardian->job }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $guardian->address }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>{{ $guardian->phone }}</td>
                        </tr>
                        <tr>
                            <th>Siswa</th>
                            <td><a href="{{ route('students.show', $guardian->student->id) }}">
                                    {{ $guardian->student->name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if ($guardian->image)
                                    <img src="{{ $guardian->image_url }}" alt="{{ $guardian->name }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
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
