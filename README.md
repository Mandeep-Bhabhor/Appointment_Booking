# Appointment Booking System

A Laravel-based appointment booking system with separate user and admin dashboards. Users can book appointments, and admins can approve, reject, or reschedule them.

## 🚀 Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates + Tailwind CSS 4.0
- **Database**: MySQL
- **Build Tool**: Vite
- **Testing**: Pest PHP

## 📋 Prerequisites

Before running this project, make sure you have:

- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL database server
- Git

## 🛠️ Installation & Setup

### 1. Clone the Repository
```bash
git clone <repository-url>
cd <project-folder>
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
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
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Create Database
Create a MySQL database named `appointment_booking`:
```sql
CREATE DATABASE appointment_booking;
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Build Frontend Assets
```bash
npm run build
```

## 🎯 Running the Application

### Development Mode (Recommended)
Run all services concurrently (server, queue, and vite):
```bash
composer dev
```

This starts:
- Laravel development server on `http://localhost:8000`
- Queue worker for background jobs
- Vite dev server for hot module replacement

### Manual Mode
If you prefer to run services separately:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Queue Worker:**
```bash
php artisan queue:listen
```

**Terminal 3 - Vite Dev Server:**
```bash
npm run dev
```

### Production Build
```bash
npm run build
php artisan serve
```

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

## 🧪 Testing

Run tests using Pest:
```bash
composer test
```

Or directly:
```bash
php artisan test
```

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

# Run database seeders (if any)
php artisan db:seed

# Rollback migrations
php artisan migrate:rollback

# Fresh migration (drop all tables and re-migrate)
php artisan migrate:fresh

# Code formatting (Laravel Pint)
./vendor/bin/pint

# View application logs
php artisan pail
```

## 📝 Creating Admin User

Since there's no admin seeder, you need to manually create an admin user in the database:

```sql
INSERT INTO users (name, email, password, role, created_at, updated_at) 
VALUES ('Admin', 'admin@example.com', '$2y$12$your_hashed_password', 'admin', NOW(), NOW());
```

Or use Laravel Tinker:
```bash
php artisan tinker
```
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
    'role' => 'admin'
]);
```

## 🐛 Troubleshooting

### Database Connection Error
- Verify MySQL is running
- Check `.env` database credentials
- Ensure database exists

### Permission Errors
```bash
# Windows (run as administrator)
icacls storage /grant Users:F /T
icacls bootstrap/cache /grant Users:F /T
```

### Vite Not Loading
- Ensure `npm run dev` is running
- Check `vite.config.js` configuration
- Clear browser cache

### Queue Not Processing
- Ensure queue worker is running: `php artisan queue:listen`
- Check `QUEUE_CONNECTION=database` in `.env`

## 📦 Key Features

✅ User registration and authentication  
✅ Role-based access control (Customer/Admin)  
✅ Appointment booking with validation  
✅ Admin approval workflow  
✅ Appointment rescheduling  
✅ Dashboard statistics  
✅ Responsive UI with Tailwind CSS  
✅ Session-based authentication  
✅ Database queue for background jobs  

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 📧 Support

For issues or questions, please open an issue in the repository.
