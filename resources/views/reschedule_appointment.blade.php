<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Appointment</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Reschedule Appointment</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('appointment.reschedule', $appointment->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Current Date & Time</label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $appointment->appointment_date }}"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Date & Time</label>
                            <input type="datetime-local"
                                   name="appointment_date"
                                   class="form-control"
                                   required>
                        </div>

                        @error('appointment_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <button class="btn btn-warning w-100 mt-3">Reschedule</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('admindashboard') }}" class="text-decoration-none">
                            Back to Dashboard
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>
