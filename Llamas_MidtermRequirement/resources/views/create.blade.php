<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Post</title>
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
            <h1>Create Your Blog Post</h1>
            <p>Share your story</p>
        </div>
    </div>

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Create Blog</h2>
                <form action="/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Body</label>
                        <textarea class="form-control" name="body" rows="5" required>{{ old('body') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category" id="category" required>
                            <option value="Lifestyle" {{ old('category') == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                            <option value="Technology" {{ old('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="Travel" {{ old('category') == 'Travel' ? 'selected' : '' }}>Travel</option>
                            <option value="Creativity" {{ old('category') == 'Creativity' ? 'selected' : '' }}>Creativity</option>
                            <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <div id="tags-container">
                            <!-- tags -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary">Post Blog</button>
                    <a href="/home" class="btn btn-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
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
        const tagsContainer = document.getElementById('tags-container');

        function updateTags() {
            const selectedCategory = categorySelect.value;
            tagsContainer.innerHTML = ''; // Clear existing tags

            if (selectedCategory && categoryTagMap[selectedCategory]) {
                categoryTagMap[selectedCategory].forEach(tag => {
                    const label = document.createElement('label');
                    label.className = 'me-3';
                    label.innerHTML = `
                        <input type="checkbox" name="tags[]" value="${tag}"> ${tag}
                    `;
                    tagsContainer.appendChild(label);
                });
            }
        }

        updateTags();

        categorySelect.addEventListener('change', updateTags);
    </script>
</body>
</html>