<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>

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

        <div class="text-center mb-4">
            <h3>Welcome, {{ auth()->user()->name }}</h3>
            <p class="text-muted">This is your dashboard.</p>
        </div>

        <div class="d-flex justify-content-center">
            <a href="{{ route('appointment.create') }}" class="btn btn-success btn-lg">
                Create Appointment
            </a>
        </div>

        <div class="mt-5">
            <h5>Your Appointments</h5>
            <div class="card mt-3">
                <div class="card-body">

                    @if ($appointments->isEmpty())
                        <p class="text-muted">You have no appointments scheduled.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($appointments as $appointment)
                                <li class="list-group-item">
                                    <strong>Date:</strong> {{ $appointment->appointment_date }} <br>
                                    <strong>Reason:</strong> {{ $appointment->reason }} <br>
                                    <strong>Status:</strong> {{ $appointment->status }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
