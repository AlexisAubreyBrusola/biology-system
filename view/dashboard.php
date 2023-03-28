<?php
    require_once '../include/session.inc.php';
    require_once '../models/user.model.php';
    require_once '../controllers/login.controller.php';
    require_once '../config/dbConn.config.php';

    $db = new DbConn();
    $model = new User($db);
    $controller = new Login($model);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../include/head.inc.php' ?>
    <title>Dashboard</title>
</head>
<body>
    <?php include_once '../include/header.inc.php';?>
    <main>
        <?php include_once '../include/sidebar.inc.php';?>
        
    </main>
    <?php include_once '../include/footer.inc.php'?>
</body>
</html>