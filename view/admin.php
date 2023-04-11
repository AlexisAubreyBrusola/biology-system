<?php
session_start();
require_once '../config/dbConn.config.php';
require_once '../models/user.model.php';
require_once '../controllers/add-admin.controller.php';

$db = new DBConn;
$model = new User($db);
$controller = new AddAdminController($model);

// Check if form was submitted
if(isset($_POST['submit'])) {
    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Call addAdminController function
    $result = $controller->addAdminController($firstname, $lastname, $email, $password, $confirm_password);

    // Display message based on result
	$message = $result ? 'Admin added successfully' : 'Error adding admin';
	echo '<div class="alert alert-' . ($result ? 'success' : 'danger') . '" role="alert">' . $message . '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once '../include/head.inc.php' ?>
	<title>Admin</title>
</head>
<body>
	<?php include_once '../include/header.inc.php'?>
	<main class="d-flex flex-nowrap">
		<?php include_once '../include/sidebar.inc.php'?>
		<section class="content p-5 w-100" style="margin-left: 320px;">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">To add an admin</button>

			<!-- Modal -->
			<div class="modal modal-lg fade" id="addAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<!-- Modal Title -->
					<div class="modal-header">
						<h1 class="modal-title fs-4 fw-semibold" id="addAdminModalLabel"><i class="fa-solid fa-user-plus me-2 fs-4"></i>Add Admin</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<!-- Modal Content -->
					<div class="modal-body fw-semibold">
						<form action="./admin.php" method="POST">
							<div class="row">
								<div class="col-lg-6">
									<label for="firstname" class="col-form-label">First Name</label>
									<input type="text" class="form-control form-control-lg" id="firstname" name="firstname" placeholder="Enter First Name" required>
								</div>

								<div class=" col-lg-6">
									<label for="lastname" class="col-form-label">Last Name</label>
									<input type="text" class="form-control form-control-lg" id="lastname" name="lastname" placeholder="Enter Last Name" required>
								</div>
							</div>

							<div class="panel mb-3">
								<label for="email" class="col-form-label">Email</label>
								<input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter Email" required>
							</div>

							<label for="password" class="">Password</label>
							<div class="input-group mb-3">
								<input type="password" name="password" id="password" class="form-control form-control-lg border-2 fw-normal"placeholder="Password" aria-label="password" aria-describedby="password" required>
								<button class="input-group-text border-2" type="button" id="show-password1"><i class="fa-solid fa-eye" id="eye-icon"></i></button>
							</div>

							<label for="confirmPassword" class="">Re-enter Password</label>
							<div class="input-group mb-3">
								<input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg border-2 fw-normal"placeholder="Confirm Password" aria-label="confirmPassword" aria-describedby="confirmPassword" required>
								<button class="input-group-text border-2" type="button" id="show-password2"><i class="fa-solid fa-eye" id="eye-icon"></i></button>
							</div>
					</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" name="submit" class="btn btn-primary bg-blue">Add Admin</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php include_once '../include/footer.inc.php'?>
	<script>
        const passwordInput1 = document.getElementById('password');
        const passwordInput2 = document.getElementById('confirm_password');
        const showPasswordBtn1 = document.getElementById('show-password1');
        const showPasswordBtn2 = document.getElementById('show-password2');


        showPasswordBtn1.addEventListener('click', () => {
            if (passwordInput1.type === 'password') {
                passwordInput1.type = 'text';
                showPasswordBtn1.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
            } else {
                passwordInput1.type = 'password';
                showPasswordBtn1.innerHTML = '<i class="fa-solid fa-eye" id="eye-icon">';
            }
        })

		showPasswordBtn2.addEventListener('click', () => {
            if (passwordInput2.type === 'password') {
                passwordInput2.type = 'text';
                showPasswordBtn2.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
            } else {
                passwordInput2.type = 'password';
                showPasswordBtn2.innerHTML = '<i class="fa-solid fa-eye" id="eye-icon">';
            }
        })
    </script>
</body>
</html>