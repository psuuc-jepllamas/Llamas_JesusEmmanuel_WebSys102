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
            <a href="{{ route('students.create') }}" class="btn btn-primary">Create Student</a>
        </div>

            <table id="myTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email address</th>
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
                        <tr>
                            <td colspan="8" class="text-center">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
@endsection