<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Image Upload (Single + Multiple)</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .image-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .image-container {
            text-align: center;
        }
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
        }
        .pagination-controls {
            margin-bottom: 20px;
            text-align: center;
        }
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-top: 20px;
        }
        .custom-pagination .page-link {
            font-size: 1rem; /* Reduced from 1.5rem */
            padding: 5px 10px; /* Reduced from 10px 20px */
            background-color: #fff;
            border: 1px solid #dee2e6;
            color: #0d6efd;
            border-radius: 3px;
        }
        .custom-pagination .page-link:hover {
            background-color: #0d6efd;
            color: #fff;
        }
        .custom-pagination .page-item.active .page-link {
            background-color: #0d6efd;
            color: #fff;
            border-color: #0d6efd;
        }
        .custom-pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            pointer-events: none;
        }
        .pagination-info {
            margin-top: 10px;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem; /* Reduced font size for info text */
        }
    </style>
</head>
<body class="container mt-5">
    <h1>Single Image Upload</h1>
    <form action="{{ route('photos.store.single') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <br>
    <h1>Multiple Images Upload</h1>
    <form action="{{ route('photos.store.multiple') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="images[]" class="form-control" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    @if(session('success'))
        <p class="text-success mt-3">{{ session('success') }}</p>
    @endif
    <br>
    <h1>Uploaded Images</h1>
    <div class="pagination-controls">
        <form action="{{ route('photos.create') }}" method="get" class="d-inline">
            <label for="per_page" class="me-2">Items per page:</label>
            <select name="per_page" id="per_page" class="form-select d-inline" style="width: auto;" onchange="this.form.submit()">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            </select>
        </form>
    </div>
    <div class="image-grid">
        @foreach($photos as $photo)
            <div class="image-container">
                <img src="{{ asset('images/' . $photo->image) }}" alt="{{ $photo->image }}" class="image-preview">
                <form action="{{ route('photos.destroy', $photo->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this image?');" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>