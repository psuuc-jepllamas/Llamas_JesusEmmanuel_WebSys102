<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #5D6D7E;
        }
        .card {
            width: 700px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #f8f9fa;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-register {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .btn-register:hover {
            background-color: #218838;
        }
        .error-container {
            max-height: 120px;
            overflow-y: auto;
            margin-bottom: 10px;
        }
        .error-list {
            list-style-type: none;
            padding-left: 0;
            display: flex;
            flex-wrap: wrap;
        }
        .error-list li {
            flex: 0 0 50%;
            display: flex;
            align-items: center;
        }
        .error-list li::before {
            content: "• ";
            color: red;
            font-weight: bold;
            display: inline-block;
            width: 1em;
        }
    </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card">
        <h3 class="text-center">Register</h3>
        <p class="text-center text-muted">Create your account. It's free and only takes a minute.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger error-container">
                <ul class="error-list mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('activity') }}" method="post">
            @csrf

            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="fname" class="form-control" placeholder="First Name" value="{{ old('fname') }}">
                </div>
                <div class="col-md-6">
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" value="{{ old('lname') }}">
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">Sex</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" value="Male">
                    <label class="form-check-label">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" value="Female">
                    <label class="form-check-label">Female</label>
                </div>
            </div>

            <div class="mt-3">
                <input type="text" name="mobile" class="form-control" placeholder="Mobile Phone (0998-123-456)" value="{{ old('mobile') }}" pattern="^(0998|0999|0920)-\d{3}-\d{3}$" title="Enter a valid mobile number">
            </div>

            <div class="mt-3">
                <input type="tel" name="telno" class="form-control" placeholder="Tel No." value="{{ old('telno') }}" pattern="[0-9]*" inputmode="numeric">
            </div>

            <div class="mt-3">
                <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate') }}">
            </div>

            <div class="mt-3">
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ old('address') }}">
            </div>

            <div class="mt-3">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            </div>

            <div class="mt-3">
                <input type="url" name="website" class="form-control" placeholder="Website (optional)" value="{{ old('website') }}">
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-register w-100">Register Now</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
