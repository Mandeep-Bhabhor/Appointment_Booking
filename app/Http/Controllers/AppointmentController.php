<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppointmentController extends Controller
{
    

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            
            'phone' => 'required|string|max:20',
            'reason' => 'required|string|max:1000',
            'appointment_date' => 'required|date|after:now',
        ]);
        // Create a new appointment using the validated data
        $appointment = Appointment::create([
            'user_id' => Auth()->id(),
            'phone' => $validatedData['phone'],
            'reason' => $validatedData['reason'],
            'appointment_date' => $validatedData['appointment_date'],
        ]);
        // Here you would typically save the appointment to the database
        // For demonstration, we'll just return a success message

        return redirect()->route('userdashboard')->with('success', 'Appointment booked successfully!');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // If the user is an admin, retrieve all appointments
            $appointments = Appointment::all();
        } else {
            // If the user is a regular user, retrieve only their appointments
            $appointments = Appointment::where('user_id', $user->id)->get();
        }

        return view('userdashboard', compact('appointments'));
    }


    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment approved successfully.');
    }
    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'rejected';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment rejected successfully.');
    }

    public function rescheduleForm($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('reschedule_appointment', compact('appointment'));
    }

    public function reschedule(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);

    $validatedData = $request->validate([
        'appointment_date' => [
            'required',
            'date',
            'after:now', // must be future
            'after:' . $appointment->appointment_date, // must be after original date
        ],
    ]);

    $appointment->appointment_date = $validatedData['appointment_date'];
    $appointment->status = 'pending'; 
    $appointment->save();

    return redirect()->route('admindashboard')
        ->with('success', 'Appointment rescheduled successfully.');
}

}
