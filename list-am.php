<?php 
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['user_name'])) {
    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "list_am_db";

    $conn = new mysqli($sname, $uname, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }  

    $sql = "SELECT last_name, first_name, avail_time, end_time, room, email FROM am_list";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Appointment List</title>
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
            <h1>Available Doctors</h1>
            <div class="date-time">
                <i class="fa fa-calendar"></i>
                <?php
                    date_default_timezone_set('Asia/Manila'); // Set your timezone
                    echo date('l, M d, Y, h:i A'); // Display formatted date and time
                ?>
            </div>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <table id="appointmentTable">
                <tr>
                    <th>last Name</th>
                    <th>First Name</th>
                    <th>Avail Time</th>
                    <th>End Shift</th>
                    <th>Room</th>
                    <th>Email</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["last_name"]; ?></td>
                        <td><?php echo $row["first_name"]; ?></td>
                        <td><?php echo $row["avail_time"]; ?></td>
                        <td><?php echo $row["end_time"]; ?></td>
                        <td><?php echo $row["room"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>

        <?php 
        $conn->close();
        ?>
        </div>
    </section>
</div>

<script>
    function searchTable() {
        const input = document.getElementById("searchBar").value.toUpperCase();
        const table = document.getElementById("appointmentTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName("td");
            let rowMatches = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toUpperCase().includes(input)) {
                    rowMatches = true;
                    break;
                }
            }

            rows[i].style.display = rowMatches ? "" : "none";
        }
    }

    document.getElementById("toggleFormButton").addEventListener("click", function() {
        const form = document.getElementById("addPatientForm");
        form.style.display = form.style.display === "none" ? "block" : "none";
    });
</script>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit();
}
?>