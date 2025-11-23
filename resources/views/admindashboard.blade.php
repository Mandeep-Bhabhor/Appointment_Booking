<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>

            <div class="ms-auto">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-outline-light btn-sm">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <h2 class="mb-4">Welcome, Admin</h2>

        {{-- Cards Section --}}
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>Total Users</h5>
                        <h3>{{ $usersCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>Total Appointments</h5>
                        <h3>{{ $appointmentsCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5>Pending Appointments</h5>
                        <h3>{{ $pendingAppointmentsCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- Table Section --}}
        <div class="mt-5">
            <h4>Recent Appointments</h4>

            <div class="card mt-3 shadow-sm">
                <div class="card-body">

                    @if (empty($recentAppointments) || $recentAppointments->isEmpty())
                        <p class="text-muted">No recent appointments.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>User</th>
                                    <th>Phone</th>
                                    <th>Reason</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($recentAppointments as $apt)
                                    <tr>
                                        <td>{{ $apt->user->name ?? 'Unknown User' }}</td>
                                        <td>{{ $apt->phone }}</td>
                                        <td>{{ $apt->reason }}</td>
                                        <td>{{ $apt->appointment_date }}</td>
                                        <td>{{ ucfirst($apt->status) }}</td>

                                        <td>
                                            <div class="btn-group" role="group">

                                                {{-- Approve --}}
                                                <form action="{{ route('appointment.approve', $apt->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-success btn-sm">Approve</button>
                                                </form>

                                                {{-- Reject --}}
                                                <form action="{{ route('appointment.reject', $apt->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-danger btn-sm">Reject</button>
                                                </form>

                                                {{-- Reschedule --}}
                                                <a href="{{ route('appointment.reschedule.form', $apt->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Reschedule
                                                </a>


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    @endif

                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
