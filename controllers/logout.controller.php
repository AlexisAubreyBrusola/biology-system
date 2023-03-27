<?php
require_once '../config/dbConn.config.php';
require_once '../models/user.model.php';
require_once '../controllers/login.controller.php';

$db = new DBConn;
$model = new User($db);
$controller = new Login($model);

if ($SESSION['user_type'] == 'admin') {
    $logoutController->logoutAdmin(); 
} else if ($_SESSION['user_type'] == 'borrower') {
    $logoutController->logoutBorrower();
}

header("Location: ../view/login.view.php");
exit();