<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Reports</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <!-- jQuery (required by DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
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
                    <a href="/admin/manage-posts" class="dashboard"><i class="material-icons">display_settings</i><span>Manage Posts</span></a>
                    <a href="/admin/reports" class="dashboard" style="background-color: black;"><i class="material-icons" style="color: white;">report</i><span class="text-white">Reports</span></a>
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
                        <a class="navbar-brand" href="#"> Reports </a>
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

                @if(count($reports) > 0)
                    <div class="table-responsive">
                        <table id="reportsTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Report ID</th>
                                    <th>Reported By</th>
                                    <th>Type</th>
                                    <th>Content</th>
                                    <th>Reported At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->reported_by }}</td>
                                        <td>{{ $report->type }}</td>
                                        <td>
                                            @if($report->type === 'Post' && $report->content)
                                                <a href="/post/{{ $report->content->id }}">{{ Str::limit($report->content->title, 50) }}</a>
                                            @elseif($report->type === 'Comment' && $report->content)
                                                {{ Str::limit($report->content->comment, 50) }}
                                            @else
                                                [Content Not Found]
                                            @endif
                                        </td>
                                        <td>{{ date('F j, Y g:i A', strtotime($report->created_at)) }}</td>
                                        <td>
                                            <form action="{{ route('admin.delete-report', $report->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Mark this report as done and delete it?')">Done</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No reports available.</p>
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

            $('#reportsTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 10,
                "language": {
                    "emptyTable": "No reports available in table"
                }
            });
        });
    </script>
</body>
</html>