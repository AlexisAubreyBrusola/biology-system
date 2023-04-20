<?php
	session_start();
	require_once '../config/dbConn.config.php';
	require_once '../models/user.model.php';
	require_once '../controllers/add-borrower.controller.php';
	require_once '../models/dropdown-option.model.php';
	require_once '../controllers/dropdown-option.controller.php';

	$db = new DBConn;
	$DropDownModel = new DropDownOptionModel($db);
	$DropDownController = new DropdownOptionController($DropDownModel);

	$borrowerTypes = $DropDownController->showBorrowerTypes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once '../include/head.inc.php' ?>
	<title>Add Borrower</title>
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
						<label for="borrower-type" class="col-form-label fw-semibold">Borrower Type:</label>
						<select class="form-select form-select-lg mb-3" name="borrower_type" id="borrower-type" onchange="changeContent()">
							<option selected>-- Select a borrower type --</option>
							<?php foreach($borrowerTypes as $borrowerType): ?>
								<option value="<?php echo $borrowerType['borrower_type_id']; ?>"><?php echo ucwords($borrowerType['type_name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div id="additional-info-form">

					</div>

					<div class="panel mb-3">
						<label for="contact_no" class="col-form-label fw-semibold">Phone Number</label>
						<input type="tel" class="form-control form-control-lg" id="contact_no" pattern="[0-9]{11}" placeholder="Enter Phone Number">
					</div>

					<div class="panel mb-3">
						<label for="email" class="col-form-label fw-semibold">Email</label>
						<input type="email" class="form-control form-control-lg" id="email" placeholder="Enter Email">
					</div>

					<div class="panel mb-3">
						<label for="password" class="col-form-label fw-semibold">Password</label>
						<input type="text" class="form-control form-control-lg" id="password" name="password" placeholder="Enter Password" style="pointer-events: none;">
					</div>

					<div class="panel mb-3 passwordInput">

					</div>

					<div class="panel mb-3">
						<label for="confirmpass" class="col-form-label fw-semibold">Confirm Password</label>
						<input type="password" class="form-control form-control-lg" id="confirmpass" placeholder="Re-enter Password">
					</div>

					<button type="submit" name="submit" id="AddAdminBtn" class="btn btn-primary bg-blue fw-semibold">Add Borrower</button>
				</form>
			</div>
		</section>
	</main>

	<script>
		function changeContent() {
			let selectBox = document.getElementById('borrower-type');
			let selectedValue = selectBox.options[selectBox.selectedIndex].value;
			let contentDiv = document.getElementById('additional-info-form');

			// Change the content of the div based on the selected value
			if (selectedValue == '1') {
				contentDiv.innerHTML = `<div class="panel mb-3 mb-3">
											<label for="student-id" class="col-form-label fw-semibold">Student ID</label>
											<input type="text" class="form-control form-control-lg id-number" id="student-id" placeholder="Enter Student's ID Number">
										</div>
										
										<div class="row">
											<div class="col-lg-6 col-sm-12 mb-3">
												<label for="course" class="col-form-label fw-semibold">Course</label>
												<input type="text" class="form-control form-control-lg" id="course" placeholder="Enter Student's Course">
											</div>

											<div class="col-lg-6 col-sm-12 mb-3">
												<label for="yearAndBlock" class="col-form-label fw-semibold">Year and Block</label>
												<input type="text" class="form-control form-control-lg" id="year-block" placeholder="Enter Student's Year and Block">
											</div>
										</div>
										`;

				const idNumberInput = document.querySelector('.id-number');
				const passwordInput = document.querySelector('#password');

				idNumberInput.addEventListener('input', function() {
				passwordInput.value = idNumberInput.value;
				});

			} else if (selectedValue == '2') {
				contentDiv.innerHTML = `<div class="row">
											<div class="col-lg-6 col-sm-12 mb-3">
												<label for="faculty-id" class="col-form-label fw-semibold">Faculty's ID Number</label>
												<input type="text" class="form-control form-control-lg id-number" id="faculty-id" placeholder="Enter Faculty's ID Number">
											</div>

											<div class="col-lg-6 col-sm-12 mb-3">
												<label for="faculty-department" class="col-form-label fw-semibold">Faculty's Department</label>
												<input type="text" class="form-control form-control-lg" id="faculty-department" placeholder="Enter Faculty's Department">
											</div>
										</div>
											`;

				const idNumberInput = document.querySelector('.id-number');
				const passwordInput = document.querySelector('#password');

				idNumberInput.addEventListener('input', function() {
				passwordInput.value = idNumberInput.value;
				});

			} else if (selectedValue == '3'){
				contentDiv.innerHTML = `<div class="panel mb-3 mb-3">
											<label for="research-id" class="col-form-label fw-semibold">Research Staff's ID Number</label>
											<input type="text" class="form-control form-control-lg id-number" id="research-id" placeholder="Enter Research Staff's ID Number">
										</div>
										`;

				const idNumberInput = document.querySelector('.id-number');
				const passwordInput = document.querySelector('#password');

				idNumberInput.addEventListener('input', function() {
				passwordInput.value = idNumberInput.value;
				});

			} else {
				contentDiv.innerHTML = "";
			}
		}
	</script>
</body>
<?php include_once '../include/footer.inc.php'?>
</html>