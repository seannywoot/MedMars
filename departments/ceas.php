<?php 
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['user_name'])) {
    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "patient_list";

    $conn = new mysqli($sname, $uname, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_patient'])) {
        $stmt = $conn->prepare("INSERT INTO ceas_list (patient_number, last_name, first_name, hospital, gender, age, department) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", 
            $_POST['patient_number'], 
            $_POST['last_name'], 
            $_POST['first_name'], 
            $_POST['hospital'], 
            $_POST['gender'], 
            $_POST['age'], 
            $_POST['department']
        );

        if ($stmt->execute()) {
            $_SESSION['message'] = "New patient added successfully";
            header("Location: ceas.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_patient'])) {
        $stmt = $conn->prepare("DELETE FROM ceas_list WHERE patient_number = ?");
        $stmt->bind_param("s", $_POST['patient_number']);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Patient deleted successfully";
            header("Location: ceas.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_patient'])) {
    
        $stmt = $conn->prepare("UPDATE ceas_list 
                                SET patient_number = ?, last_name = ?, first_name = ?, hospital = ?, gender = ?, age = ?, department = ? 
                                WHERE patient_number = ?");
    
        if ($stmt === false) {
            die("SQL Error: " . $conn->error);
        }
    
        $stmt->bind_param(
            "sssssiss",
            $_POST['patient_number'], 
            $_POST['last_name'], 
            $_POST['first_name'], 
            $_POST['hospital'], 
            $_POST['gender'], 
            $_POST['age'], 
            $_POST['department'], 
            $_POST['original_patient_number']
        );
        

        if ($stmt->execute()) {
            $_SESSION['message'] = "Patient updated successfully";
            header("Location: ceas.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $sql = "SELECT patient_number, last_name, first_name, hospital, gender, age, department FROM ceas_list";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Departments</title>
    <link rel="stylesheet" href="../css/department.css"/>
    <script src="https://kit.fontawesome.com/a7da5612c9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <nav>
        <ul>
        <li><a href="../dashboard.php" class="logo">
            <img src="../assets/logo.png" alt="logo">
            <span class="nav-item">GC-MedMaRS</span>
        </a></li>
        <li><a href="../home.php">
            <i class="fa-solid fa-building-user"></i>
            <span class="nav-item">Departments</span>
        </a></li>
        <li><a href="../appointment.php">
            <i class="fa-solid fa-calendar-check"></i>
            <span class="nav-item">Appointment List</span>
        </a></li>
        <li><a href="../user.php">
            <i class="fa-solid fa-user"></i>
            <span class="nav-item">User Profile</span>
        </a></li>
        <li><a href="../logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span class="nav-item">Log out</span>
        </a></li>
        </ul>
    </nav>

    <section class="main">
        <div class="top">
            <h1>Student List</h1>
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

        <div class="popup-dep" id="popup-dep">
            <img src="../assets/close.png" alt="Close" class="closebtn-dep" id="closePopup">
            <div class="add-form">
                <h2>Add New Student</h2>
                <form action="ceas.php" method="POST">
                    <input type="text" name="patient_number" placeholder="Patient Number" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="hospital" placeholder="Hospital" required>
                    <input type="text" name="gender" placeholder="Gender" required>
                    <input type="text" name="age" placeholder="Age" required>
                    <input type="text" name="department" placeholder="Department" required>
                    <button type="submit" name="add_patient">Add Student</button>
                </form>
            </div>
        </div>
        <button id="togglePopupButton" class="add-patient-btn">Add Student</button>
        
        <div class="popup-edit" id="popup-edit">
            <img src="../assets/close.png" alt="Close" class="closebtn-edit" id="closeEditPopup">
            <div class="edit-form">
                <h2>Edit Student</h2>
                <form action="ceas.php" method="POST">
                    <input type="hidden" name="original_patient_number" id="edit_original_patient_number">
                    <input type="text" name="patient_number" id="edit_patient_number" placeholder="Patient Number" required>
                    <input type="text" name="last_name" id="edit_last_name" placeholder="Last Name" required>
                    <input type="text" name="first_name" id="edit_first_name" placeholder="First Name" required>
                    <input type="text" name="hospital" id="edit_hospital" placeholder="Hospital" required>
                    <input type="text" name="gender" id="edit_gender" placeholder="Gender" required>
                    <input type="text" name="age" id="edit_age" placeholder="Age" required>
                    <input type="text" name="department" id="edit_department" placeholder="Department" required>
                    <button type="submit" name="update_patient">Save Changes</button>
                </form>

            </div>
        </div>

            <?php if ($result->num_rows > 0): ?>
                <table id="patientTable">
                    <tr>
                        <th>Student Number</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Hospital</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["patient_number"]; ?></td>
                            <td><?php echo $row["last_name"]; ?></td>
                            <td><?php echo $row["first_name"]; ?></td>
                            <td><?php echo $row["hospital"]; ?></td>
                            <td><?php echo $row["gender"]; ?></td>
                            <td><?php echo $row["age"]; ?></td>
                            <td><?php echo $row["department"]; ?></td>
                            <td>
                                <form action="ceas.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="patient_number" value="<?php echo $row['patient_number']; ?>">
                                    <button type="submit" name="delete_patient" class="delete-btn" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</button>
                                </form>
                                <button class="edit-btn" onclick="openEditPopup(
                                    '<?php echo $row['patient_number']; ?>',
                                    '<?php echo $row['last_name']; ?>',
                                    '<?php echo $row['first_name']; ?>',
                                    '<?php echo $row['hospital']; ?>',
                                    '<?php echo $row['gender']; ?>',
                                    '<?php echo $row['age']; ?>',
                                    '<?php echo $row['department']; ?>'
                                )">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No patient records found.</p>
            <?php endif; ?>

            <?php 
            $conn->close();
            ?>
            
        </section>
    </div>
    

    <script>
        function searchTable() {
            const input = document.getElementById("searchBar").value.toUpperCase();
            const table = document.getElementById("patientTable");
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

        function openEditPopup(patient_number, last_name, first_name, hospital, gender, age, department) {

        document.getElementById("edit_original_patient_number").value = patient_number;
        document.getElementById("edit_patient_number").value = patient_number;
        document.getElementById("edit_last_name").value = last_name;
        document.getElementById("edit_first_name").value = first_name;
        document.getElementById("edit_hospital").value = hospital;
        document.getElementById("edit_gender").value = gender;
        document.getElementById("edit_age").value = age;
        document.getElementById("edit_department").value = department;

        const popup = document.getElementById("popup-edit");
        popup.classList.add("active");
    }

        document.addEventListener("DOMContentLoaded", () => {
            const closeEditButton = document.getElementById("closeEditPopup");
            closeEditButton.addEventListener("click", () => {
                const popup = document.getElementById("popup-edit");
                popup.classList.remove("active");
            });
        });
    </script>
</body>
</html>

<?php 
} else {
    header("Location: ../login.php");
    exit();
}
?>
