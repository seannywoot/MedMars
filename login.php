<?php 
session_start();
include "config/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)){
        header("Location: login.php?error=Username is required");
        exit();
    } else if (empty($pass)) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? AND password = ?");
        $stmt->bind_param("ss", $uname, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['ID'] = $row['ID'];
                header("Location: dashboard.php");
                exit();
            } else {
                header("Location: login.php?error=Incorrect Username or Password");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect Username or Password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>
