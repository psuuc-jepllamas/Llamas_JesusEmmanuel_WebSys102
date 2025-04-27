@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Product</h1>

        <div class="mb-3">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to Records</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">First name</label>
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $student->firstname) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Last name</label>
                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $student->lastname) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $student->address) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Student ID</label>
                        <input type="text" name="studentID" class="form-control" value="{{ old('studentID', $student->studentID) }}" required>
                    </div>
                    <div class="mb-3">
                    <label for="course" class="form-label">Course</label>
                        <select name="course" id="course">
                            <option value="BS Information Technology" {{ old('course', $student->course) == 'BS Information Technology' ? 'selected' : '' }}>BS Information Technology</option>
                            <option value="AB English Language" {{ old('course', $student->course) == 'AB English Language' ? 'selected' : '' }}>AB English Language</option>
                            <option value="Bachelor of Early Childhood Education" {{ old('course', $student->course) == 'Bachelor of Early Childhood Education' ? 'selected' : '' }}>Bachelor of Early Childhood Education</option>
                            <option value="Bachelor of Secondary Education" {{ old('course', $student->course) == 'Bachelor of Secondary Education' ? 'selected' : '' }}>Bachelor of Secondary Education</option>
                            <option value="BS Civil Engineering" {{ old('course', $student->course) == 'BS Civil Engineering' ? 'selected' : '' }}>BS Civil Engineering</option>
                            <option value="BS Electrical Engineering" {{ old('course', $student->course) == 'BS Electrical Engineering' ? 'selected' : '' }}>BS Electrical Engineering</option>
                            <option value="BS Mechanical Engineering" {{ old('course', $student->course) == 'BS Mechanical Engineering' ? 'selected' : '' }}>BS Mechanical Engineering</option>
                            <option value="BS Computer Engineering" {{ old('course', $student->course) == 'BS Computer Engineering' ? 'selected' : '' }}>BS Computer Engineering</option>
                            <option value="BS Mathematics" {{ old('course', $student->course) == 'BS Mathematics' ? 'selected' : '' }}>BS Mathematics</option>
                            <option value="BS Architecture" {{ old('course', $student->course) == 'BS Architecture' ? 'selected' : '' }}>BS Architecture</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Year Level</label>
                        <select name="yearlevel" id="">
                            <option value="1st Year" {{ old('yearlevel', $student->yearlevel) == '1st Year' ? 'selected' : '' }}>1st Year</option>
                            <option value="2nd Year" {{ old('yearlevel', $student->yearlevel) == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3rd Year" {{ old('yearlevel', $student->yearlevel) == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4th Year" {{ old('yearlevel', $student->yearlevel) == '4th Year' ? 'selected' : '' }}>4th Year</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
