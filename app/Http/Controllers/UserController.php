<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // Handle user registration logic here
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'customer', // Set default role as 'customer'
            'password' => bcrypt($request->password),
        ]);

        // Redirect to a desired route after registration
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function authenticate(Request $request)
    {
        // Handle user login logic here
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('userdashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function adminDashboard()
    {
        $usersCount = User::count();
        $appointmentsCount = Appointment::count();
        $pendingAppointmentsCount = Appointment::where('status', 'pending')->count();

        $recentAppointments = Appointment::latest()->take(5)->get();

        return view('admindashboard', compact(
            'usersCount',
            'appointmentsCount',
            'pendingAppointmentsCount',
            'recentAppointments'
        ));
    }

    public function adminAuthenticate(Request $request)
    {
        // Handle admin login logic here
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Authentication passed for admin...
                return redirect()->route('admindashboard');
            } else {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'You do not have admin access.',
                ]);
            }
        }

    }
    public function adminLogin()
    {
        return view('adminlogin');
    }
}
