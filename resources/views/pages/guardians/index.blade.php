@extends('layouts.app')

@section('title')
    Guards
@endsection

@push('extra-style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Guards</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">List of Guards</h6>
                <a href="{{ route('guardians.create') }}" class="btn btn-primary">
                    <span class="text">New Guard</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Student</th>
                                <th>Relationship</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guardians as $guardian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $guardian->id_number }}</td>
                                    <td>{{ $guardian->name }}</td>
                                    <td>{{ $guardian->student->name }}</td>
                                    <td>{{ $guardian->relationship }}</td>
                                    <td>{{ $guardian->phone }}</td>
                                    <td>
                                        <a href="{{ route('guardians.edit', $guardian->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('guardians.reset-password', $guardian->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-key"></i>
                                        </a>

                                        <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
