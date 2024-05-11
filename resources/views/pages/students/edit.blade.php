@extends('layouts.app')

@section('title')
    Edit Student
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Student</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">-- Choose status --</option>
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
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Enter name" value="{{ $student->name }}"
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
                                <label>Place of Birth</label>
                                <input type="text" name="place_of_birth" placeholder="Enter place of birth"
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
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" placeholder="Enter date of birth"
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
                                <label>Gender</label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">-- Choose gender --</option>
                                    <option value="male" @if ($student->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if ($student->gender == 'female') selected @endif>Female</option>
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
                                <label>Grade</label>
                                <select name="grade_id" class="form-control @error('grade_id') is-invalid @enderror">
                                    <option value="">-- Choose grade --</option>
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
                        <label>Phone</label>
                        <input type="text" name="phone" placeholder="Enter phone" value="{{ $student->phone }}"
                            class="form-control" @error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" placeholder="Enter address" class="form-control @error('address') is-invalid @enderror">{{ $student->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" name="image" placeholder="Enter photo" value="{{ old('image') }}"
                            class="form-control" @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <span class="text">Cancel</span>
                    </a>
                    <button class="btn btn-primary" type="submit">Save Change</button>
                </div>
            </form>
        </div>
    </div>
@endsection
