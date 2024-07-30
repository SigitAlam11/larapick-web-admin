@extends('layouts.app')

@section('title')
    Detail Wali
@endsection

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
                        <td>{{ $guardian->student->name }}</td>
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
@endsection
