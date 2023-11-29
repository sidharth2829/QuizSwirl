<?php
session_start();
include 'connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_table WHERE username = '$username' AND password = '$password'";
    $result = $link->query($sql);

    if ($result->num_rows == 1) {
        // Valid credentials
        $admin = $result->fetch_assoc();
        $_SESSION['admin_id'] = $admin['admin_id']; // Store admin ID in session for further use
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard or any desired page
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}

$link->close();
?>
