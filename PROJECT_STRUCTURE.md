# GC-MedMaRS Project Structure

## Directory Organization

The project has been organized into a clean, maintainable structure:

```
GC-MedMaRS/
├── assets/                     # Static assets and media files
│   ├── CCS logo.jpg           # College of Computer Studies logo
│   ├── logo.png               # Main application logo
│   └── close.png              # Close button icon for modals
│
├── config/                     # Configuration files
│   └── db_conn.php            # Database connection configuration
│
├── css/                       # Stylesheets
│   ├── index.css              # Login page styles
│   ├── main.css               # Dashboard and main layout styles
│   ├── home.css               # Home page and general styles
│   └── department.css         # Department-specific page styles
│
├── Database/                  # Database schema and setup files
│   ├── appointment_list.sql   # Appointment database schema
│   ├── appointments.sql       # Appointments table structure
│   ├── list_am_db.sql        # Morning appointment list database
│   ├── patient_list.sql      # Patient records database schema
│   ├── test_db.sql           # User authentication database
│   ├── user_list.sql         # User list table structure
│   └── users.sql             # Users table structure
│
├── departments/               # Department-specific modules
│   ├── cahs.php              # College of Allied Health Sciences
│   ├── cba.php               # College of Business and Accountancy
│   ├── ccs.php               # College of Computer Studies
│   ├── ceas.php              # College of Education, Arts, and Sciences
│   └── chtm.php              # College of Hospitality and Tourism Management
│
├── js/                        # JavaScript files (currently empty)
├── pages/                     # Additional pages (currently empty)
│
├── index.php                  # Login page (entry point)
├── dashboard.php              # Main dashboard with statistics
├── home.php                   # Departments overview page
├── appointment.php            # Appointment management
├── user.php                   # User profile management
├── login.php                  # Authentication handler
├── logout.php                 # Session termination
├── data.php                   # Data processing for charts
├── list-am.php               # Morning appointment list
├── README.md                  # Project documentation
└── PROJECT_STRUCTURE.md       # This file
```

## File Organization Benefits

### 1. **Separation of Concerns**
- **Assets**: All images and media files in one location
- **Config**: Database and configuration files isolated
- **CSS**: All stylesheets organized by purpose
- **Departments**: Department-specific functionality modularized

### 2. **Maintainability**
- Easy to locate and modify specific components
- Clear separation between frontend and backend logic
- Consistent file naming conventions

### 3. **Scalability**
- New departments can be easily added to the departments folder
- Additional CSS files can be added without cluttering the root
- Asset management is centralized

### 4. **Security**
- Configuration files are separated from public assets
- Database connection details are isolated in config folder

## Path Updates Made

All file references have been updated to reflect the new structure:

### Main Files
- `index.php`: Updated CSS and asset paths
- `dashboard.php`: Updated CSS and asset paths
- `home.php`: Updated CSS, asset, and department page paths
- `appointment.php`: Updated CSS and asset paths
- `user.php`: Updated CSS and asset paths
- `list-am.php`: Updated CSS and asset paths
- `login.php`: Updated database config path

### Department Files
All department files (`cahs.php`, `cba.php`, `ccs.php`, `ceas.php`, `chtm.php`) have been updated with:
- Relative paths to parent directory (`../`) for navigation
- Correct asset paths (`../assets/`)
- Correct CSS paths (`../css/`)
- Correct login redirect paths (`../login.php`)

## Database Structure

The system uses three main databases with SQL schema files provided in the `Database/` folder:

1. **test_db**: User authentication
   - `test_db.sql`: Main database schema
   - `users.sql`: Users table structure
   - `user_list.sql`: User list table structure

2. **patient_list**: Student medical records (separate tables for each department)
   - `patient_list.sql`: Patient records database schema

3. **appointment_list**: Appointment scheduling and management
   - `appointment_list.sql`: Appointment database schema
   - `appointments.sql`: Appointments table structure
   - `list_am_db.sql`: Morning appointment list database

## Next Steps for Development

1. **JavaScript Organization**: Add JavaScript files to the `js/` folder
2. **Additional Pages**: Use the `pages/` folder for future page additions
3. **Documentation**: Keep README.md updated with new features
4. **Version Control**: Consider adding .gitignore for sensitive config files
5. **Security**: Implement environment variables for database credentials

This organization provides a solid foundation for future development and maintenance of the GC-MedMaRS system.