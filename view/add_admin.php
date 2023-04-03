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
	<?php include_once '../include/head.inc.php'?>
    <title>Admin</title>
</head>
<body>
<?php include_once '../include/header.inc.php'?>

			<main class="row " style="height: 100vh;">
				<div class="sidebar container-sm g-0 pt-0">	
					<?php include_once '../include/sidebar.inc.php'?>
				</div>

				<section class="admin-form-section col-lg-12">  
				<div class="container-md form-group col-lg-6" style="padding-top: 8rem;">
				<a class="d-flex align-items-left text-black fw-bold fs-4"><i class="fa-solid fa-user-plus me-2 fs-4"></i>Add Admin</a>
					
				<form>
					<div class="row">
        			<div class="col-md-6 mb-3">
            			<label for="firstname" class="col-form-label">First Name</label>
            			<input type="text" class="form-control form-control-lg" id="firstname" placeholder="Enter First Name">
        			</div>
        			<div class="col-md-6 mb-3">
            			<label for="lastname" class="col-form-label">Last Name</label>
            			<input type="text" class="form-control form-control-lg" id="lastname" placeholder="Enter Last Name">
        			</div>
    			</div>
					<div class="panel mb-3">
    					<label for="email" class="col-form-label">Email</label>
    					<input type="email" class="form-control form-control-lg" id="email" placeholder="Enter Email">
					</div>
					<div class="panel mb-3">
						<label for="password" class="col-form-label">Password</label>
						<input type="password" class="form-control form-control-lg" id="password" placeholder="Enter Password">
					</div>
					<div class="panel mb-3">
						<label for="confirmpass" class="col-form-label">Re-enter Password</label>
						<input type="password" class="form-control form-control-lg" id="confirmpass" placeholder="Re-enter Password">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			</section>
		</main>

		<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    		$password = $_POST['password'];
    		$confirmpass = $_POST['confirmpass'];

    		if ($password != $confirmpass) {
        		$password_error = 'Passwords do not match.';
    		} else {
       		 // Passwords match, do something here
    		}
		}
		?>
		<?php include_once '../include/footer.inc.php' ?>
</body>
</html>

