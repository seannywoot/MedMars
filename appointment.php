<?php 
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['user_name'])) {
    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "appointment_list";

    $conn = new mysqli($sname, $uname, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_appointment'])) {
        $patient_number = $_POST['patient_number'];
        $last_name = $_POST['last_name'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $doctor = $_POST['doctor_id'];
        $doc_name = $_POST['doc_name'];

        $sql = "INSERT INTO appointments (patient_number, last_name, date, time, doctor_id, doc_name, status) 
                VALUES ('$patient_number', '$last_name', '$date', '$time', '$doctor', '$doc_name', 'Pending')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "New appointment added successfully";
            header("Location: appointment.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
        $patient_number = $_POST['patient_number'];
        $new_status = $_POST['status'];

        echo "Updating status for Patient Number: $patient_number to $new_status"; // Debug message

        $sql = "UPDATE appointments SET status='$new_status' WHERE patient_number='$patient_number'";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Appointment status updated successfully";
            header("Location: appointment.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT patient_number, last_name, date, time, doctor_id, doc_name, status FROM appointments";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Appointment List</title>
    <link rel="stylesheet" href="css/department.css"/>
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
            <h1>Appointment</h1>
            <div class="date-time">
                <i class="fa fa-calendar"></i>
                <?php
                    date_default_timezone_set('Asia/Manila'); 
                    echo date('l, M d, Y, h:i A'); 
                ?>
            </div>
        </div>

        <div class="search">
        <input type="text" id="searchBar" class="searchBar" placeholder="Search for patients..." onkeyup="searchTable()">
        </div>

        <div class="popup" id="popup">
            <img src="assets/close.png" alt="Close" class="closebtn" id="closePopup">
            <div class="add-form">
                <h2>Add New Appointment</h2>
                <form action="appointment.php" method="POST">
                    <input type="text" name="patient_number" placeholder="Patient Number" required>
                    <input type="text" name="last_name" placeholder="Student Name" required>
                    <input type="date" name="date" placeholder="Date" required>
                    <input type="time" name="time" placeholder="Time" required>
                    <input type="text" name="doctor_id" placeholder="Doctor Number" required>
                    <input type="text" name="doc_name" placeholder="Doctor Name" required>
                    <button type="submit" name="add_appointment">Add Appointment</button>
                </form>
            </div>
        </div>
        <button id="togglePopupButton" class="add-patient-btn">Add Appointment</button>

        <?php if ($result->num_rows > 0): ?>
            <table id="appointmentTable">
                <tr>
                    <th>Patient Number</th>
                    <th>Student Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor Number</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["patient_number"]; ?></td>
                        <td><?php echo $row["last_name"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["time"]; ?></td>
                        <td><?php echo $row["doctor_id"]; ?></td>
                        <td><?php echo $row["doc_name"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td>
                            <form action="appointment.php" method="POST" style="display:inline;">
                                <input type="hidden" name="patient_number" value="<?php echo $row['patient_number']; ?>">
                                <input type="hidden" name="update_status" value="1">
                                <select name="status" class="status-select" onchange="this.form.submit()">
                                    <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Complete" <?php echo $row['status'] == 'Complete' ? 'selected' : ''; ?>>Complete</option>
                                    <option value="Canceled" <?php echo $row['status'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No appointment records found.</p>
        <?php endif; ?>

        <?php 
        $conn->close();
        ?>

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

    document.addEventListener("DOMContentLoaded", () => {
        const popup = document.getElementById("popup");
        const toggleButton = document.getElementById("togglePopupButton");
        const closeButton = document.getElementById("closePopup");

        toggleButton.addEventListener("click", () => {
            console.log("Toggle button clicked");
            popup.classList.add("active");
            console.log("Popup active class added");
        });

        closeButton.addEventListener("click", () => {
            console.log("Close button clicked");
            popup.classList.remove("active");
            console.log("Popup active class removed");
        });
    });

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






