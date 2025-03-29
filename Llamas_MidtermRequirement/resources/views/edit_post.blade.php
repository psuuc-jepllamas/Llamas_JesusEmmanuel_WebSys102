<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="d-flex">
                <img class="mt-1 me-2" src="{{ asset('images/blinklog_logo.png') }}" width="30" height="30">
                <a class="navbar-brand" href="#">Blinklog</a>
            </div>
            <div class="d-flex align-items-center">
                <a href="/home" class="nav-link me-5">Back to Home</a>
                <a href="/profile" class="nav-link me-2">{{ $username }}</a>
                <a href="/logout" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="subscription-section">
        <div class="container">
            <h1>Edit Your Blog</h1>
            <p>Update your story</p>
        </div>
    </div>

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>

    <div class="container mt-5 mb-5">
        <h2>Edit Blog Post</h2>
        <form action="/update/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Body</label>
                <textarea class="form-control" name="body" rows="5" required>{{ $post->body }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload New Image (Optional)</label>
                <input type="file" class="form-control" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="/home" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>

    <div class="footer">
        <div class="container">
            <div class="text-center mt-4">
                <p style="font-size: 0.85rem; color: #666;">© 2025 Emman Llamas. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>