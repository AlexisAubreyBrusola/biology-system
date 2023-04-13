<?php
session_start();
require_once '../config/dbConn.config.php';
require_once '../models/user.model.php';
require_once '../controllers/add-borrower.controller.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once '../include/head.inc.php' ?>
	<title>Borrower</title>
</head>
<body>
	<?php include_once '../include/header.inc.php'?>
	<main class="d-flex flex-nowrap">
		<?php include_once '../include/sidebar.inc.php'?>
		<section class="content w-100" style="margin-left: 320px; padding: 3rem 5rem">
			<h1 class="modal-title fs-4 fw-semibold mb-3" id="addAdminModalLabel"><i class="fa-solid fa-user-plus me-2 fs-4"></i>Add Borrower</h1>
			<div class="form-container">
				<form action="" method="POST">
					<div class="row">
						<div class="col-lg-6 col-sm-12 mb-3">
							<label for="firstname" class="col-form-label fw-semibold">First Name</label>
							<input type="text" class="form-control form-control-lg" id="firstname" placeholder="Enter First Name">
						</div>

						<div class="col-lg-6 col-sm-12 mb-3">
							<label for="lastname" class="col-form-label fw-semibold">Last Name</label>
							<input type="text" class="form-control form-control-lg" id="lastname" placeholder="Enter Last Name">
						</div>
					</div>

					<div class="panel mb-3">
						<label for="borrower_type" class="fw-medium fw-semibold">Select borrower type</label>
						<select type="borrower_type" class="form-control form-control-lg" id="borrower_type" placeholder="Select Borrower Type"></select>
					</div>

					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
						<span class="input-group-text" id="basic-addon2">@example.com</span>
					</div>

					<div class="panel mb-3">
						<label for="contact_no" class="col-form-label fw-semibold">Phone Number</label>
						<input type="tel" class="form-control form-control-lg" id="contact_no" pattern="[0-9]{10}" placeholder="Enter Phone Number">
					</div>

					<div class="panel mb-3">
						<label for="email" class="col-form-label fw-semibold">Email</label>
						<input type="email" class="form-control form-control-lg" id="email" placeholder="Enter Email">
					</div>

					<div class="panel mb-3">
						<label for="password" class="col-form-label fw-semibold">Password</label>
						<input type="password" class="form-control form-control-lg" id="password" placeholder="Enter Password">
					</div>

					<div class="panel mb-3">
						<label for="confirmpass" class="col-form-label fw-semibold">Re-enter Password</label>
						<input type="password" class="form-control form-control-lg" id="confirmpass" placeholder="Re-enter Password">
					</div>
					<button type="submit" name="submit" id="" class="btn btn-primary bg-blue fw-semibold">Add Admin</button>
				</form>
			</div>
		</section>
	</main>
</body>
<?php include_once '../include/footer.inc.php'?>
</html>