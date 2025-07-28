<?php 
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['user_name'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Departments</title>
    <link rel="stylesheet" href="css/home.css"/>
    <script src="https://kit.fontawesome.com/a7da5612c9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <nav>
        <ul>
        <li><a href="dashboard.php" class="logo">
            <img src="assets/logo.png" alt="logo">
            <span class="nav-item">GC-MedMaRS</span>
        </a></li>
        <li><a href="home.php">
            <i class="fa-solid fa-building-user"></i>
            <span class="nav-item">Departments</span>
        </a></li>
        <li><a href="appointment.php">
            <i class="fa-solid fa-calendar-check"></i>
            <span class="nav-item">Appointment List</span>
        </a></li>
        <li><a href="user.php">
            <i class="fa-solid fa-user"></i>
            <span class="nav-item">User Profile</span>
        </a></li>
        <li><a href="logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span class="nav-item">Log out</span>
        </a></li>
        </ul>
    </nav>
    
    
    <section class="main">
        <div class="top">
            <h1>Departments</h1>
            <div class="date-time">
                <i class="fa fa-calendar"></i>
                <?php
                    date_default_timezone_set('Asia/Manila'); 
                    echo date('l, M d, Y, h:i A'); 
                ?>
            </div>
        </div>
        <div class="main-skills">
        <div class="card">
            <i class="fa-solid fa-stethoscope"></i>
            <h3>College of Allied Health Studies</h3>
            <button onclick="window.location.href='departments/cahs.php'; ">Students</button>
        </div>
        <div class="card">
            <i class="fa-solid fa-calculator"></i>
            <h3>College of Business and Accountancy</h3>
            <button onclick="window.location.href='departments/cba.php'; ">Students</button>
        </div>
        <div class="card">
            <i class="fa-solid fa-desktop"></i>
            <h3>College of Computer Studies</h3>
            <button onclick="window.location.href='departments/ccs.php'; ">Students</button>
        </div>
        <div class="card">
            <i class="fa-solid fa-school"></i>
            <h3>College of Education, Arts, and Sciences</h3>
            <button onclick="window.location.href='departments/ceas.php'; ">Students</button>
        </div>
        <div class="card">
            <i class="fa-solid fa-kitchen-set"></i>
            <h3>College of Hospitality and Tourism Management</h3>
            <button onclick="window.location.href='departments/chtm.php'; ">Students</button>
        </div>
        </div>

    <section class="main-clinic">
        <h1>Clinic Available Time</h1>
        <div class="course-box">
        <div class="course">
            <div class="box">
                <h3>Morning</h3>
                <p>8:00am - 12:00pm</p>
                <button onclick="window.location.href='list-am.php'; ">See Lists</button>
            </div>
            <div class="box">
                <h3>Break Time</h3>
                <p>12:00pm - 1:00pm</p>
            </div>
            <div class="box">
                <h3>Afternoon</h3>
                <p>1:00pm - 5:00pm</p>
                <button onclick="window.location.href=''; ">See Lists</button>
            </div>
            </div>
        </div>
    </section>
    </section>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit();
}
?>