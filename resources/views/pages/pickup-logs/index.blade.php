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
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pickupLogs as $pickupLog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pickupLog->student->name }}</td>
                                    <td>{{ $pickupLog->guardian->name ?? '-' }}</td>
                                    <td>{{ $pickupLog->pickup_time }}</td>
                                    <td>{{ $pickupLog->admin->name }}</td>
                                    @if ($pickupLog->status == 'done')
                                        <td><span class="badge badge-success">{{ $pickupLog->status }}</span></td>
                                    @else
                                        <td><span class="badge badge-warning">{{ $pickupLog->status }}</span></td>
                                    @endif
                                    <td>{{ $pickupLog->note ?? '-' }}</td>
                                    <td>
                                        @if ($pickupLog->image)
                                            <a href="#" data-toggle="modal"
                                                data-target="#imageModal{{ $loop->iteration }}">
                                                <img src="{{ asset('storage/pickups/' . $pickupLog->image) }}"
                                                    alt="{{ $pickupLog->name }}" width="80" height="80">
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageModal{{ $loop->iteration }}" tabindex="-1"
                                                role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="imageModalLabel">Pratinjau Foto</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/pickups/' . $pickupLog->image) }}"
                                                                alt="{{ $pickupLog->name }}"
                                                                style="max-width: 100%; max-height: 500px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
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
