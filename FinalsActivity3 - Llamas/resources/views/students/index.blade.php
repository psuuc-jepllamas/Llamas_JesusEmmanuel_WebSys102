@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Students</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('students.create') }}" class="btn btn-primary">+ Create Student</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Filter by Course</h5>
                <form method="GET" action="{{ route('students.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <select name="course" class="form-control">
                            <option value="">All Courses</option>
                            <option value="BS Information Technology" {{ request('course') == 'BS Information Technology' ? 'selected' : '' }}>BS Information Technology</option>
                            <option value="AB English Language" {{ request('course') == 'AB English Language' ? 'selected' : '' }}>AB English Language</option>
                            <option value="Bachelor of Early Childhood Education" {{ request('course') == 'Bachelor of Early Childhood Education' ? 'selected' : '' }}>Bachelor of Early Childhood Education</option>
                            <option value="Bachelor of Secondary Education" {{ request('course') == 'Bachelor of Secondary Education' ? 'selected' : '' }}>Bachelor of Secondary Education</option>
                            <option value="BS Civil Engineering" {{ request('course') == 'BS Civil Engineering' ? 'selected' : '' }}>BS Civil Engineering</option>
                            <option value="BS Electrical Engineering" {{ request('course') == 'BS Electrical Engineering' ? 'selected' : '' }}>BS Electrical Engineering</option>
                            <option value="BS Mechanical Engineering" {{ request('course') == 'BS Mechanical Engineering' ? 'selected' : '' }}>BS Mechanical Engineering</option>
                            <option value="BS Computer Engineering" {{ request('course') == 'BS Computer Engineering' ? 'selected' : '' }}>BS Computer Engineering</option>
                            <option value="BS Mathematics" {{ request('course') == 'BS Mathematics' ? 'selected' : '' }}>BS Mathematics</option>
                            <option value="BS Architecture" {{ request('course') == 'BS Architecture' ? 'selected' : '' }}>BS Architecture</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
        </div>

        <table id="myTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email address</th>
                    <th>Address</th>
                    <th>Student ID</th>
                    <th>Course</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>QR Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->firstname }}</td>
                        <td>{{ $student->lastname }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->studentID }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->created_at }}</td>
                        <td>{{ $student->updated_at }}</td>
                        <td class="text-center">
                            <div class="mx-auto" style="width: 100px;">
                                {!! $student->qr !!}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-success btn-sm">View</a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
