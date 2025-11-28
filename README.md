# Appointment Booking System

A Laravel-based appointment booking system with separate user and admin dashboards. Users can book appointments, and admins can approve, reject, or reschedule them.

## 🚀 Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates + Bootstrap CSS 5.0
- **Database**: MySQL
- **Build Tool**: Vite

## 📋 Prerequisites

Before running this project, make sure you have:

- PHP 8.2 or higher
- Composer
- Node.js & npm (not necessary if you haven't used JavaScript)
- MySQL database server
- Git

## 🛠️ Installation & Setup

### 1. Clone the Repository
```bash
git clone <repository-url>
cd <project-folder>
```

### 2. Environment Configuration
```bash
copy .env.example .env
```

Edit `.env` file and configure your database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=appointment_booking
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=file
```

**Important**: Change `SESSION_DRIVER=database` to `SESSION_DRIVER=file` in your `.env` file.

### 3. Install Dependencies
```bash
composer install
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed Admin User
```bash
php artisan db:seed
```

This command creates an admin user for accessing the admin dashboard.

## 🎯 Running the Application

### Development Mode
```bash
php artisan serve
```

This starts the Laravel development server on `http://localhost:8000`

## 📁 Project Structure

```
appointment-booking/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AppointmentController.php  # Appointment CRUD operations
│   │       └── UserController.php         # Authentication & user management
│   └── Models/
│       ├── User.php                       # User model (customers & admins)
│       └── Appointment.php                # Appointment model
├── database/
│   └── migrations/
│       ├── 2025_11_23_081722_create_users_table.php
│       ├── 2025_11_23_082336_create_appointments_table.php
│       └── 2025_11_23_101847_add_reason_to_appointments.php
├── resources/
│   └── views/
│       ├── login.blade.php                # User login page
│       ├── register.blade.php             # User registration page
│       ├── userdashboard.blade.php        # User dashboard (view appointments)
│       ├── create_appointment.blade.php   # Book new appointment
│       ├── adminlogin.blade.php           # Admin login page
│       ├── admindashboard.blade.php       # Admin dashboard (manage appointments)
│       └── reschedule_appointment.blade.php # Reschedule appointment form
├── routes/
│   └── web.php                            # Application routes
└── public/
    └── index.php                          # Application entry point
```

## 🔐 User Roles & Access

### Customer Role
- Register and login
- Book appointments
- View their own appointments
- See appointment status (pending/approved/rejected)

### Admin Role
- Login via admin portal
- View all appointments
- Approve/reject appointments
- Reschedule appointments
- View dashboard statistics

## 🌐 Application Routes

### Public Routes
- `GET /` - User login page
- `GET /register` - User registration page
- `POST /register` - Register new user
- `POST /login` - User authentication
- `GET /adminlogin` - Admin login page
- `POST /adminlogin` - Admin authentication

### Protected Routes (Require Authentication)
- `GET /userdashboard` - User dashboard
- `GET /create-appointment` - Appointment booking form
- `POST /store-appointment` - Save new appointment
- `GET /admindashboard` - Admin dashboard
- `PATCH /appointment/{id}/approve` - Approve appointment
- `PATCH /appointment/{id}/reject` - Reject appointment
- `GET /appointment/{id}/reschedule` - Reschedule form
- `POST /appointment/{id}/reschedule` - Save rescheduled date
- `POST /logout` - Logout user

## 💾 Database Schema

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - User role (customer/admin)
- `created_at`, `updated_at` - Timestamps

### Appointments Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `phone` - Contact phone number
- `reason` - Appointment reason/description
- `appointment_date` - Scheduled date and time
- `status` - Appointment status (pending/approved/rejected/rescheduled)
- `created_at`, `updated_at` - Timestamps

## 🔄 Application Flow

### User Journey
1. User registers via `/register`
2. User logs in via `/`
3. User books appointment via `/create-appointment`
4. User views appointment status on `/userdashboard`
5. User waits for admin approval

### Admin Journey
1. Admin logs in via `/adminlogin`
2. Admin views all appointments on `/admindashboard`
3. Admin can:
   - Approve appointments (status → approved)
   - Reject appointments (status → rejected)
   - Reschedule appointments (change date, status → pending)

## 🔧 Useful Commands

```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Rollback migrations
php artisan migrate:rollback

# Fresh migration (drop all tables and re-migrate)
php artisan migrate:fresh
```

## 📝 Admin User Access

After running `php artisan db:seed`, use the seeded admin credentials to login at `/adminlogin`.


## 📦 Key Features

✅ User registration and authentication  
✅ Role-based access control (Customer/Admin)  
✅ Appointment booking with validation  
✅ Admin approval workflow  
✅ Appointment rescheduling  
✅ Dashboard statistics  
✅ Responsive UI with Bootstrap CSS  
✅ File-based session management  

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
