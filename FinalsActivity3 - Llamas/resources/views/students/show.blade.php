@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Student Details</h1>

        <div class="mb-3">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to Records</a>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>ID:</strong> {{ $student->id }}</p>
                <p class="card-text"><strong>First name:</strong> {{ $student->firstname }}</p>
                <p class="card-text"><strong>Last name:</strong> {{ $student->lastname }}</p>
                <p class="card-text"><strong>Email address:</strong> {{ $student->email }}</p>
                <p class="card-text"><strong>Address:</strong> {{ $student->address }}</p>
                <p class="card-text"><strong>Student ID:</strong> {{ $student->studentID }}</p>
                <p class="card-text"><strong>Course:</strong> {{ $student->course }}</p>
                <p class="card-text"><strong>Year Level:</strong> {{ $student->yearlevel }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $student->created_at }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $student->updated_at }}</p>
                <div class="text-center">
                    <div class="qr-code mx-auto" style="width: 200px;">
                        {!! $qr !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
