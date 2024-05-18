@extends('layouts.app')

@section('title')
    Log Penjemputan
@endsection

@push('extra-style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Log Penjemputan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Log Penjemputan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Wali</th>
                                <th>Waktu</th>
                                <th>Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pickupLogs as $pickupLog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pickupLog->student->name }}</td>
                                    <td>{{ $pickupLog->guardian->name }} </td>
                                    <td>{{ $pickupLog->pickup_time }}</td>
                                    <td>{{ $pickupLog->admin->name }} </td>
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
