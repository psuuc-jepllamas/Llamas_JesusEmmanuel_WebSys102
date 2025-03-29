<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

    <div class="container mb-5 mt-5 all-posts">
        <h2>My Blog Posts</h2>
        @if(count($posts) > 0)
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="post-card">
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="post-img">
                            @else
                                <div class="post-placeholder"></div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="meta">{{ $post->author }} • {{ date('M d Y', strtotime($post->created_at)) }}</p>
                                <div class="d-flex align-items-center">
                                    <a href="/post/{{ $post->id }}" class="read-more me-2"><i class="bi bi-arrow-up-right-square-fill"></i></a>
                                    <form action="/report/post/{{ $post->id }}" method="POST" onsubmit="return confirm('Are you sure you want to report this post?');">
                                        @csrf
                                        <button type="submit" class="btn p-0 border-0 bg-transparent">
                                            <i class="bi bi-flag text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <h3>{{ $post->title }}</h3>
                            <p>{{ Str::limit($post->body, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="tags">
                                    <span class="badge">{{ $post->category }}</span>
                                    @foreach(explode(',', $post->tags) as $tag)
                                        <span class="badge me-2">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                                <div class="d-flex">
                                    <a href="/edit/{{ $post->id }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <a href="/delete/{{ $post->id }}" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No posts found.</p>
        @endif
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