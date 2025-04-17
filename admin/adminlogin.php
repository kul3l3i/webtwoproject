<?php
session_start();

// Load admin XML file (separate from regular users)
$adminXml = simplexml_load_file('data/admins.xml');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    foreach ($adminXml->admin as $admin) {
        if ((string)$admin->username === $username && 
            password_verify($password, (string)$admin->password)) {
            // Set admin session
            $_SESSION["admin_logged_in"] = true;
            $_SESSION["admin_username"] = $username;
            header("Location: admin/dashboard.php");
            exit();
        }
    }
    
    $error = "Invalid username or password";
}
?>