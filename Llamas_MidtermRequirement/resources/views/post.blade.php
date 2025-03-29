<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $post->title }}</title>
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
                <form action="/home" method="GET" class="d-flex me-3">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="d-flex align-items-center">
                <a href="/home" class="nav-link me-5">Back to home</a>
                <a href="/profile" class="nav-link me-2">{{ $username }}</a>
                <a href="/logout" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>{{ $post->title }}</h1>
        <p class="meta">{{ $post->author }} • {{ date('d M Y', strtotime($post->created_at)) }}</p>
        @if($post->image)
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid mb-3" style="max-width: 600px;">
        @endif
        <p>{{ $post->body }}</p>
        <div class="tags mb-3">
            <span class="badge">{{ $post->category }}</span>
            @foreach(explode(',', $post->tags) as $tag)
                <span class="badge">{{ trim($tag) }}</span>
            @endforeach
        </div>
        <div class="d-flex justify-content-end">
            <form action="/report/post/{{ $post->id }}" method="POST" onsubmit="return confirm('Are you sure you want to report this post?');">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Report</button>
            </form>
        </div>
    </div>

    <div class="container mt-5">
        <h3>Comments</h3>
        @php
            $comments = DB::select("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC", [$post->id]);
        @endphp

        @if(count($comments) > 0)
            @foreach($comments as $comment)
                <div class="card mb-2" style="padding: 0.5rem; max-width: 400px;">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="meta mb-0" style="font-size: 0.9rem;">{{ $comment->author }} • {{ date('d M Y, g:i A', strtotime($comment->created_at)) }}</p>
                            <form action="/report/comment/{{ $comment->id }}" method="POST" onsubmit="return confirm('Are you sure you want to report this comment?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger p-1" style="font-size: 0.8rem;">Report</button>
                            </form>
                        </div>
                        <p class="mb-0" style="font-size: 1rem;">{{ $comment->comment }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">No comments yet.</p>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="/comment/{{ $post->id }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <textarea name="comment" class="form-control" rows="3" placeholder="Add a comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
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