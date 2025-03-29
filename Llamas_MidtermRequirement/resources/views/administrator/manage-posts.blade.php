<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Posts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="body-overlay"></div>
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="{{ asset('images/blinklog_logo.png') }}" class="img-fluid"/><span>Blinklog</span></h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="/admin" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
                    <a href="/admin/pending-posts" class="dashboard"><i class="material-icons">pending_actions</i><span>Pending Posts</span></a>
                    <a href="/admin/users" class="dashboard"><i class="material-icons">manage_accounts</i><span>Manage Accounts</span></a>
                    <a href="/admin/manage-posts" class="dashboard" style="background-color: black;"><i class="material-icons" style="color: white">display_settings</i><span class="text-light">Manage Posts</span></a>
                    <a href="/admin/reports" class="dashboard"><i class="material-icons">report</i><span>Reports</span></a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <div class="top-navbar">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-none d-none">
                            <span class="material-icons">arrow_back_ios</span>
                        </button>
                        <a class="navbar-brand" href="#"> Manage Posts </a>
                        <div class="collapse navbar-collapse d-lg-flex justify-content-end" id="navbarSupportedContent">
                            <div class="d-flex align-items-center">
                                <p class="mb-2 me-3">{{ $username }}</p>
                                <a class="btn btn-danger" href="/admin/login">Logout</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header card-header-text">
                                <h4 class="card-title">All Posts</h4>
                            </div>
                            <div class="card-content table-responsive">
                                <table id="postsTable" class="table table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Post Title</th>
                                            <th>Author</th>
                                            <th>Posted On</th>
                                            <th>Status</th>
                                            <th>Comments</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->author }}</td>
                                                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y, g:i A') }}</td>
                                                <td>{{ ucfirst($post->status) }}</td>
                                                <td>{{ $post->comment_count }}</td>
                                                <td>
                                                    @if($post->image)
                                                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="max-width: 100px; height: auto;">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No posts found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });
            $('.more-button,.body-overlay').on('click', function () {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });

            $('#postsTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 10,
                "language": {
                    "emptyTable": "No posts found."
                }
            });
        });
    </script>
</body>
</html>