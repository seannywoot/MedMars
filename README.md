# GC-MedMaRS - Gordon College Medical Records System

A comprehensive web-based medical records management system designed for Gordon College to manage student health records across different departments.

## 🏥 Overview

GC-MedMaRS (Gordon College Medical Records System) is a PHP-based web application that allows healthcare administrators to manage student medical records, appointments, and departmental data efficiently. The system provides a centralized platform for tracking student health information across five college departments.

## ✨ Features

### Core Functionality

- **User Authentication**: Secure login system for administrators
- **Dashboard**: Interactive dashboard with department statistics and charts
- **Student Records Management**: Add, edit, delete, and search student medical records
- **Appointment Scheduling**: Manage medical appointments with status tracking
- **Department Management**: Separate modules for each college department
- **Real-time Search**: Quick search functionality across all records

### Departments Supported

- **CAHS** - College of Allied Health Sciences
- **CBA** - College of Business and Accountancy
- **CCS** - College of Computer Studies
- **CEAS** - College of Education, Arts, and Sciences
- **CHTM** - College of Hospitality and Tourism Management

## 🛠️ Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Charts**: Chart.js for data visualization
- **Icons**: Font Awesome
- **AJAX**: jQuery for dynamic interactions

## 📁 Project Structure

```
GC-MedMaRS/
├── assets/                 # Static assets
│   ├── CCS logo.jpg       # College logo
│   ├── logo.png           # Main application logo
│   └── close.png          # UI icons
├── config/                 # Configuration files
│   └── db_conn.php        # Database connection
├── css/                   # Stylesheets
│   ├── index.css          # Login page styles
│   ├── main.css           # Dashboard styles
│   ├── home.css           # Home page styles
│   └── department.css     # Department pages styles
├── Database/              # Database schema and setup files
│   ├── appointment_list.sql # Appointment database schema
│   ├── appointments.sql   # Appointments table structure
│   ├── list_am_db.sql    # Morning appointment list database
│   ├── patient_list.sql  # Patient records database schema
│   ├── test_db.sql       # User authentication database
│   ├── user_list.sql     # User list table structure
│   └── users.sql         # Users table structure
├── departments/           # Department-specific modules
│   ├── cahs.php          # Allied Health Sciences
│   ├── cba.php           # Business and Accountancy
│   ├── ccs.php           # Computer Studies
│   ├── ceas.php          # Education, Arts, and Sciences
│   └── chtm.php          # Hospitality and Tourism
├── js/                    # JavaScript files (empty)
├── pages/                 # Additional pages (empty)
├── index.php             # Login page
├── dashboard.php         # Main dashboard
├── home.php              # Departments overview
├── appointment.php       # Appointment management
├── user.php              # User profile
├── login.php             # Authentication handler
├── logout.php            # Session termination
├── data.php              # Data processing for charts
└── list-am.php           # Morning appointment list
```

## 🚀 Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Web browser with JavaScript enabled

### Database Setup

The `Database/` folder contains all necessary SQL schema files for easy setup:

1. **Import the database schemas** using the provided SQL files:

   - `Database/test_db.sql` - User authentication database
   - `Database/patient_list.sql` - Patient records database
   - `Database/appointment_list.sql` - Appointment management database

2. **Alternative manual setup** (if needed):

   Create the required databases:

   ```sql
   CREATE DATABASE test_db;           -- For user authentication
   CREATE DATABASE patient_list;     -- For student records
   CREATE DATABASE appointment_list;  -- For appointments
   ```

   Import the corresponding SQL files or create tables manually using the provided schema files.

### Application Setup

1. Clone or download the project files
2. Configure database connection in `config/db_conn.php`:
   ```php
   $sname = "localhost";
   $uname = "your_username";
   $password = "your_password";
   $db_name = "test_db";
   ```
3. Place files in your web server directory
4. Access the application via web browser

## 👤 Usage

### Login

- Access the system through `index.php`
- Use administrator credentials to log in
- System redirects to dashboard upon successful authentication

### Dashboard

- View department statistics and charts
- Navigate to different modules using the sidebar
- Monitor real-time data visualization

### Managing Student Records

1. Navigate to **Departments** from the sidebar
2. Select the appropriate college department
3. Use **Add Student** to create new records
4. Search, edit, or delete existing records as needed

### Appointment Management

1. Go to **Appointment List** from the sidebar
2. Click **Add Appointment** to schedule new appointments
3. Update appointment status (Pending/Complete/Canceled)
4. Search appointments by patient details

## 🔧 Configuration

### Database Configuration

Update connection settings in `config/db_conn.php` for your environment:

- Server name/host
- Database username and password
- Database names

### Timezone Settings

The system uses Manila timezone by default. Modify in PHP files:

```php
date_default_timezone_set('Asia/Manila');
```

## 🛡️ Security Features

- Session-based authentication
- SQL injection prevention using prepared statements
- Input validation and sanitization
- Secure password handling
- Access control for protected pages

## 🎨 UI/UX Features

- Responsive design for various screen sizes
- Interactive charts and data visualization
- Modal popups for forms
- Real-time search functionality
- Intuitive navigation with Font Awesome icons

## 📊 Data Management

- **CRUD Operations**: Complete Create, Read, Update, Delete functionality
- **Search & Filter**: Advanced search across all data fields
- **Data Visualization**: Charts showing department statistics
- **Export Capabilities**: Structured data management

## 🔄 Future Enhancements

- PDF report generation
- Email notifications for appointments
- Advanced user roles and permissions
- Mobile application
- Integration with external health systems
- Backup and restore functionality

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Failed**: Check database credentials in `config/db_conn.php`
2. **Login Issues**: Verify user table exists and contains valid credentials
3. **Missing Images**: Ensure all assets are in the `assets/` directory
4. **JavaScript Errors**: Check browser console and ensure jQuery is loaded

### Error Handling

- PHP error reporting is enabled for development
- Database connection errors are displayed
- Form validation prevents invalid data submission

## 📝 License

This project is developed for educational purposes as part of Gordon College's medical records management system.

## 👥 Contributors

- Development Team: Gordon College Computer Studies Department
- System designed for healthcare administration efficiency

## 📞 Support

For technical support or questions about the system:

- Contact the IT department at Gordon College
- Review the code documentation for implementation details
- Check the troubleshooting section for common issues

---

**Note**: This system handles sensitive medical information. Ensure proper security measures and compliance with healthcare data protection regulations when deploying in a production environment.
