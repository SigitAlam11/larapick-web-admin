@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $gradesCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $studentsCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Wali</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guardiansCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Admin</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Log Penjemputan Terakhir</h6>
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
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pickupLogs as $pickupLog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pickupLog->student->name }}</td>
                                            <td>{{ $pickupLog->guardian->name ?? '-' }} </td>
                                            <td>{{ $pickupLog->pickup_time }}</td>
                                            <td>{{ $pickupLog->admin->name }}</td>
                                            @if ($pickupLog->status == 'done')
                                                <td><span class="badge badge-success">{{ $pickupLog->status }}</span></td>
                                            @else
                                                <td><span class="badge badge-danger">{{ $pickupLog->status }}</span></td>
                                            @endif
                                            <td>{{ $pickupLog->note ?? '-' }}</td>
                                            <td>
                                                @if ($pickupLog->image)
                                                    <img src="{{ asset('storage/pickups/' . $pickupLog->image) }}"
                                                        alt="{{ $pickupLog->name }}" width="80" height="80">
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
        </div>
    </div>
@endsection
