<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <a href="/admin" class="dashboard" style="background-color: black;"><i class="material-icons" style="color: white">dashboard</i><span class="text-light">Dashboard</span></a>
                    <a href="/admin/pending-posts" class="dashboard"><i class="material-icons">pending_actions</i><span>Pending Posts</span></a>
                    <a href="/admin/users" class="dashboard"><i class="material-icons">manage_accounts</i><span>Manage Accounts</span></a>
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
                        <a class="navbar-brand" href="#"> Dashboard </a>
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
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon icon-warning">
                                    <span class="material-icons">person</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Total Users</strong></p>
                                <h3 class="card-title">{{ $totalUsers }}</h3>
                            </div>
                            <div class="card">
                                <div class="stats">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon icon-rose">
                                    <span class="material-icons">post_add</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Total Posts</strong></p>
                                <h3 class="card-title">{{ $totalPosts }}</h3>
                            </div>
                            <div class="card">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon" style="color: red;">
                                    <span class="material-icons">report</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Pending Reports</strong></p>
                                <h3 class="card-title">{{ $totalReports }}</h3>
                            </div>
                            <div class="card">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header">
                                <div class="icon icon-info">
                                    <span class="material-icons">pending_actions</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="category"><strong>Pending Posts</strong></p>
                                <h3 class="card-title">{{ $totalPendingPosts }}</h3>
                            </div>
                            <div class="card">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <div class="card" style="min-height: 485px">
                            <div class="card-header card-header-text">
                                <h4 class="card-title">Users</h4>
                            </div>
                            <div class="card-content table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->username }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No users found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="card" style="min-height: 485px">
                            <div class="card-header card-header-text">
                                <h4 class="card-title">Activities</h4>
                            </div>
                            <div class="card-content">
                                <div class="streamline">
                                    @forelse($activities as $activity)
                                        <div class="sl-item {{ $activity->description === 'You approved a post' ? 'sl-success' : ($activity->description === 'You deleted a post' ? 'sl-danger' : (str_starts_with($activity->description, 'New user:') ? 'sl-primary' : 'sl-warning')) }}">
                                            <div class="sl-content">
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->format('F j, Y, g:i A') }}</small>
                                                <p>{{ $activity->description }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="sl-item">
                                            <div class="sl-content">
                                                <p>No recent activities.</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card" style="min-height: 600px">
                            <div class="card-header card-header-text d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Total Number of Users per Month</h4>
                                <div>
                                    <form action="/admin" method="GET" class="d-inline">
                                        <label for="year">Select Year: </label>
                                        <select name="year" id="year" onchange="this.form.submit()">
                                            @foreach($years as $year)
                                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="card-content">
                                <canvas id="usersPerMonthChart" style="height: 500px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card" style="min-height: 600px">
                            <div class="card-header card-header-text d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Total Number of Posts per Month</h4>
                                
                            </div>
                            <div class="card-content">
                                <canvas id="postsPerMonthChart" style="height: 500px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <nav class="d-flex">
                                    <ul class="m-0 p-0">
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-md-6">
                                <p class="copyright d-flex justify-content-end"> © Emman Llamas</p>
                            </div>
                        </div>
                    </div>
                </footer>
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

            const months = <?php echo json_encode($months); ?>;
            const usersPerMonth = <?php echo json_encode($usersPerMonth); ?>;
            const postsPerMonth = <?php echo json_encode($postsPerMonth); ?>;

            function createChart(canvasId, label, data) {
                const ctx = document.getElementById(canvasId).getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: label,
                            data: data,
                            borderColor: '#00C4B4',
                            backgroundColor: 'rgba(0, 196, 180, 0.2)',
                            fill: false,
                            tension: 0.4,
                            pointRadius: 5,
                            pointBackgroundColor: '#00C4B4',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                title: {
                                    display: false,
                                },
                                ticks: {
                                    callback: function(value, index, values) {
                                        return months[index].substring(0, 3).toUpperCase();
                                    },
                                    font: {
                                        size: 14,
                                    }
                                },
                                grid: {
                                    display: false,
                                }
                            },
                            y: {
                                title: {
                                    display: false,
                                },
                                beginAtZero: true,
                                max: Math.max(...data, 10) + 10,
                                ticks: {
                                    stepSize: 5,
                                    font: {
                                        size: 14,
                                    }
                                },
                                grid: {
                                    borderDash: [5, 5],
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    boxWidth: 20,
                                    padding: 20,
                                    font: {
                                        size: 16,
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const month = context.label;
                                        const value = context.raw;
                                        return `${month}: ${value} ${label.split(' ')[2].toLowerCase()}${value !== 1 ? 's' : ''}`;
                                    },
                                },
                                bodyFont: {
                                    size: 14,
                                }
                            },
                        },
                    },
                });
            }
            createChart('usersPerMonthChart', '# of Users per Month', usersPerMonth);
            createChart('postsPerMonthChart', '# of Posts per Month', postsPerMonth);
        });
    </script>
</body>
</html>