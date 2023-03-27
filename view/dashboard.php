<?php
    include_once '../include/session.inc.php';
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
        <h1>Hello <?php echo $_SESSION['admin_firstname'] . ' ' . $_SESSION['admin_lastname'];?> !</h1>
        <a href="../controllers/logout.controller.php">Logout</a>
    </main>
</body>
</html>