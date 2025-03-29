<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Users Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                    <a href="/admin/users" class="dashboard" style="background-color: black;"><i class="material-icons" style="color: white">manage_accounts</i><span class="text-light">Manage Accounts</span></a>
                    <a href="/admin/manage-posts" class="dashboard"><i class="material-icons">display_settings</i><span>Manage Posts</span></a>
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
                        <a class="navbar-brand" href="#"> Users Management </a>
                        <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="material-icons">more_vert</span>
                        </button>
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
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Search and Filter Form -->
                <div class="mb-4">
                    <form method="GET" action="/admin/users" class="row g-3">
                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option value="">All Statuses</option>
                                <option value="banned" {{ $status == 'banned' ? 'selected' : '' }}>Banned</option>
                                <option value="not_banned" {{ $status == 'not_banned' ? 'selected' : '' }}>Not Banned</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>

                @if(count($users) > 0)
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Registered At</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ date('F j, Y g:i A', strtotime($user->created_at)) }}</td>
                                        <td>{{ $user->post_count }}</td>
                                        <td>{{ $user->comment_count }}</td>
                                        <td>{{ $user->is_banned ? 'Banned' : 'Active' }}</td>
                                        <td>
                                            @if($user->is_banned)
                                                <form action="{{ route('admin.unban', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Unban this user?')">Unban</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.ban', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Ban this user?')">Ban</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No users found.</p>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });
            
            $('.more-button, .body-overlay').on('click', function () {
                $('#sidebar, .body-overlay').toggleClass('show-nav');
            });

            $('#usersTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 10,
                "language": {
                    "emptyTable": "No users found."
                }
            });
        });
    </script>
</body>
</html>