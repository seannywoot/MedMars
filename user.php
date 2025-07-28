<?php 
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['user_name'])) {
    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "user_list";

    $conn = new mysqli($sname, $uname, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete Patient (Doctor) using Prepared Statement
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_patient'])) {
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];

        $stmt = $conn->prepare("DELETE FROM users WHERE last_name = ? AND first_name = ?");
        $stmt->bind_param("ss", $last_name, $first_name);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Doctor deleted successfully";
            header("Location: user.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Update Patient using Prepared Statement
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_patient'])) {
        $stmt = $conn->prepare("UPDATE users SET doctor_id = ?, last_name = ?, first_name = ?, hospital = ?, email = ? WHERE doctor_id = ?");
        if ($stmt === false) {
            die("SQL Error: " . $conn->error);
        }

        $stmt->bind_param(
            "ssssss",
            $_POST['patient_number'],
            $_POST['last_name'],
            $_POST['first_name'],
            $_POST['hospital'],
            $_POST['email'],
            $_POST['original_patient_number']
        );

        if ($stmt->execute()) {
            $_SESSION['message'] = "Patient updated successfully";
            header("Location: user.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $sql = "SELECT doctor_id, last_name, first_name, hospital, email FROM users";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Profile</title>
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
                <h1>User Profile</h1>
                <div class="date-time">
                    <i class="fa fa-calendar"></i>
                    <?php
                        date_default_timezone_set('Asia/Manila'); 
                        echo date('l, M d, Y, h:i A'); 
                    ?>
                </div>
            </div>

            <div class="popup-edit" id="popup-edit">
            <img src="assets/close.png" alt="Close" class="closebtn-edit" id="closeEditPopup">
            <div class="edit-form">
                <h2>Edit Doctor/Admin</h2>
                <form action="user.php" method="POST">
                    <input type="hidden" name="original_patient_number" id="edit_original_patient_number">
                    <input type="text" name="patient_number" id="edit_patient_number" placeholder="Doctor Number" required>
                    <input type="text" name="last_name" id="edit_last_name" placeholder="Last Name" required>
                    <input type="text" name="first_name" id="edit_first_name" placeholder="First Name" required>
                    <input type="text" name="hospital" id="edit_hospital" placeholder="Hospital" required>
                    <input type="email" name="email" id="edit_email" placeholder="Email" required>
                    <button type="submit" name="update_patient">Save Changes</button>
                </form>
            </div>
        </div>

            <?php if ($result->num_rows > 0): ?>
                <table id="patientTable">
                    <tr>
                        <th>Doctor Number</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Hospital</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["doctor_id"]; ?></td>
                            <td><?php echo $row["last_name"]; ?></td>
                            <td><?php echo $row["first_name"]; ?></td>
                            <td><?php echo $row["hospital"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td>
                                <form action="user.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="last_name" value="<?php echo $row['last_name']; ?>">
                                    <input type="hidden" name="first_name" value="<?php echo $row['first_name']; ?>">
                                    <button type="submit" name="delete_patient" class="delete-btn" onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</button>
                                </form>
                                <button class="edit-btn" onclick="openEditPopup(
                                    '<?php echo $row['doctor_id']; ?>',
                                    '<?php echo $row['last_name']; ?>',
                                    '<?php echo $row['first_name']; ?>',
                                    '<?php echo $row['hospital']; ?>',
                                    '<?php echo $row['email']; ?>'
                                )">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No doctor records found.</p>
            <?php endif; ?>
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const popup = document.getElementById("popup-dep");
            const toggleButton = document.getElementById("togglePopupButton");
            const closeButton = document.getElementById("closePopup");

            toggleButton.addEventListener("click", () => {
                popup.classList.add("active");
            });

            closeButton.addEventListener("click", () => {
                popup.classList.remove("active");
            });
        });

        function openEditPopup(doctor_id, last_name, first_name, hospital, email) {
            document.getElementById("edit_original_patient_number").value = doctor_id;
            document.getElementById("edit_patient_number").value = doctor_id;
            document.getElementById("edit_last_name").value = last_name;
            document.getElementById("edit_first_name").value = first_name;
            document.getElementById("edit_hospital").value = hospital;
            document.getElementById("edit_email").value = email;

            document.getElementById("popup-edit").classList.add("active");
        }

        document.getElementById("closeEditPopup").addEventListener("click", function() {
            document.getElementById("popup-edit").classList.remove("active");
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

