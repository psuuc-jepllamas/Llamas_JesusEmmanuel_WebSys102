<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
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
                <a href="/create" class="btn btn-primary me-5">+ Create</a>
                <a href="/profile" class="nav-link me-2">{{ $username }}</a>
                <a href="/logout" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </nav>

    <div class="subscription-section">
        <div class="container">
            <h1>Blog Stories & Insights</h1>
            <p>Let the world hear you</p>
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

    <div class="container mb-5">
        <h2>Recent Posts</h2>
        @if(count($featuredPosts) > 0)
            <div class="row">
                <!-- featured post (left) -->
                <div class="col-md-8">
                    <div class="post-card">
                        <div class="row">
                            <div class="">
                                @if($featuredPosts[0]->image)
                                    <img src="{{ asset($featuredPosts[0]->image) }}" alt="{{ $featuredPosts[0]->title }}" style="width: 850px; height: 600px; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 200px; background: #e0e0e0;"></div>
                                @endif
                            </div>
                            <div style="max-width: 850px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="meta">{{ $featuredPosts[0]->author }} • {{ date('M d Y', strtotime($featuredPosts[0]->created_at)) }}</p>
                                    <a href="/post/{{ $featuredPosts[0]->id }}" style="margin-left: 590px;" class="read-more"><i class="bi bi-arrow-up-right-square-fill"></i></a>
                                    <form action="/report/post/{{ $featuredPosts[0]->id }}" method="POST" onsubmit="return confirm('Are you sure you want to report this post?');">
                                        @csrf
                                        <button type="submit" class="btn p-0 border-0 bg-transparent">
                                            <i class="bi bi-flag text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                                <h3 class="fs-3">{{ $featuredPosts[0]->title }}</h3>
                                <p class="fs-5">{{ Str::limit($featuredPosts[0]->body, 200) }}</p>
                                <div class="tags">
                                    <span class="badge">{{ $featuredPosts[0]->category }}</span>
                                    @foreach(explode(',', $featuredPosts[0]->tags) as $tag)
                                        <span class="badge">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if(count($featuredPosts) > 1)
                        <div class="post-card mb-4">
                            @if($featuredPosts[1]->image)
                                <img src="{{ asset($featuredPosts[1]->image) }}" alt="{{ $featuredPosts[1]->title }}">
                            @else
                                <div style="width: 100%; height: 150px; background: #e0e0e0;"></div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="meta">{{ $featuredPosts[1]->author }} • {{ date('M d Y', strtotime($featuredPosts[1]->created_at)) }}</p>
                                <div class="d-flex align-items-center">
                                    <a href="/post/{{ $featuredPosts[1]->id }}" class="read-more me-2"><i class="bi bi-arrow-up-right-square-fill"></i></a>
                                    <form action="/report/post/{{ $featuredPosts[1]->id }}" method="POST" onsubmit="return confirm('Are you sure you want to report this post?');">
                                        @csrf
                                        <button type="submit" class="btn p-0 border-0 bg-transparent">
                                            <i class="bi bi-flag text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <h3>{{ $featuredPosts[1]->title }}</h3>
                            <p>{{ Str::limit($featuredPosts[1]->body, 80) }}</p>
                            <div class="tags">
                                <span class="badge">{{ $featuredPosts[1]->category }}</span>
                                @foreach(explode(',', $featuredPosts[1]->tags) as $tag)
                                    <span class="badge">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if(count($featuredPosts) > 2)
                        <div class="post-card">
                            @if($featuredPosts[2]->image)
                                <img src="{{ asset($featuredPosts[2]->image) }}" alt="{{ $featuredPosts[2]->title }}">
                            @else
                                <div style="width: 100%; height: 150px; background: #e0e0e0;"></div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="meta">{{ $featuredPosts[2]->author }} • {{ date('M d Y', strtotime($featuredPosts[2]->created_at)) }}</p>
                                <div class="d-flex align-items-center">
                                    <a href="/post/{{ $featuredPosts[2]->id }}" class="read-more me-2"><i class="bi bi-arrow-up-right-square-fill"></i></a>
                                    <form action="/report/post/{{ $featuredPosts[2]->id }}" method="POST" onsubmit="return confirm('Are you sure you want to report this post?');">
                                        @csrf
                                        <button type="submit" class="btn p-0 border-0 bg-transparent">
                                            <i class="bi bi-flag text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <h3>{{ $featuredPosts[2]->title }}</h3>
                            <p>{{ Str::limit($featuredPosts[2]->body, 80) }}</p>
                            <div class="tags">
                                <span class="badge">{{ $featuredPosts[2]->category }}</span>
                                @foreach(explode(',', $featuredPosts[2]->tags) as $tag)
                                    <span class="badge">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <div class="container mb-5 all-posts">
        <h2>All Posts</h2>
        <div class="row mb-4">
            <div class="col-md-8">
                <form action="/home" method="GET" id="filterForm" class="row g-2">
                    <div class="col-md-5">
                        <select name="category" id="category" class="form-select">
                            <option value="">All Categories</option>
                            <option value="Lifestyle" {{ $selectedCategory == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                            <option value="Technology" {{ $selectedCategory == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="Travel" {{ $selectedCategory == 'Travel' ? 'selected' : '' }}>Travel</option>
                            <option value="Creativity" {{ $selectedCategory == 'Creativity' ? 'selected' : '' }}>Creativity</option>
                            <option value="Food" {{ $selectedCategory == 'Food' ? 'selected' : '' }}>Food</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="tag" id="tag" class="form-select">
                            <option value="">All Tags</option>
                            @if($selectedTag)
                                <option value="{{ $selectedTag }}" selected>{{ $selectedTag }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                    @if($search)
                        <input type="hidden" name="search" value="{{ $search }}">
                    @endif
                </form>
            </div>
        </div>
        @if(count($posts) > 0)
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="post-card">
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                            @else
                                <div class="placeholder"></div>
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
                            <div class="tags">
                                <span class="badge">{{ $post->category }}</span>
                                @foreach(explode(',', $post->tags) as $tag)
                                    <span class="badge">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $currentPage > 1 ? '/home?page=' . ($currentPage - 1) . ($selectedCategory ? '&category=' . $selectedCategory : '') . ($selectedTag ? '&tag=' . $selectedTag : '') . ($search ? '&search=' . $search : '') : '#' }}">← Prev</a>
                        </li>
                        @for($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                <a class="page-link" href="/home?page={{ $i }}{{ $selectedCategory ? '&category=' . $selectedCategory : '' }}{{ $selectedTag ? '&tag=' . $selectedTag : '' }}{{ $search ? '&search=' . $search : '' }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $currentPage < $totalPages ? '/home?page=' . ($currentPage + 1) . ($selectedCategory ? '&category=' . $selectedCategory : '') . ($selectedTag ? '&tag=' . $selectedTag : '') . ($search ? '&Simulation=' . $search : '') : '#' }}">Next →</a>
                        </li>
                    </ul>
                </nav>
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
    <script>
        const categoryTagMap = {
            'Lifestyle': ['Daily Life', 'Wellness', 'Habits', 'Home', 'Inspiration'],
            'Technology': ['Gadgets', 'AI', 'Software', 'Innovation', 'Trends'],
            'Travel': ['Destinations', 'Adventure', 'Culture', 'Tips', 'Photography'],
            'Creativity': ['Writing', 'Art', 'DIY', 'Ideas', 'Imagination'],
            'Food': ['Recipes', 'Cooking', 'Reviews', 'Cuisine', 'Nutrition']
        };

        const categorySelect = document.getElementById('category');
        const tagSelect = document.getElementById('tag');

        function updateTags() {
            const selectedCategory = categorySelect.value;
            tagSelect.innerHTML = '<option value="">All Tags</option>';
            if (selectedCategory && categoryTagMap[selectedCategory]) {
                categoryTagMap[selectedCategory].forEach(tag => {
                    const option = document.createElement('option');
                    option.value = tag;
                    option.text = tag;
                    tagSelect.appendChild(option);
                });
            }
        }
        updateTags();
        categorySelect.addEventListener('change', updateTags);
    </script>
</body>
</html>