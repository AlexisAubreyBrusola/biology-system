<?php
include_once '../include/session.inc.php';
require_once '../config/dbConn.config.php';
require_once '../models/user.model.php';
require_once '../controllers/login.controller.php';

// Create instances of DBConn, User, and Login
$db = new DBConn;
$model = new User($db);
$controller = new Login($model);

// Check the user type and call the appropriate logout function
if ($_SESSION['user_type'] == 'admin') {
    $controller->logoutAdmin();
    echo "<script type='text/javascript'>alert('Successfully logged out!');</script>";
} else if ($_SESSION['user_type'] == 'borrower') {
    $controller->logoutBorrower();
    echo "<script type='text/javascript'>alert('Successfully logged out!');</script>";
}

// Redirect to the login page
header("Location: ../view/login.php");
exit();