<?php
	session_start();
	require_once '../config/dbConn.config.php';
	// Models
	require_once '../models/user.model.php';
	require_once '../models/dropdown-option.model.php';

	// Controllers
	require_once '../controllers/add-borrower.controller.php';
	require_once '../controllers/dropdown-option.controller.php';

	$db = new DBConn;
	$UserModel = new User($db);
	$DropDownModel = new DropDownOptionModel($db);
	$DropDownController = new DropdownOptionController($DropDownModel);
	$AddBorrowerController = new AddBorrowerController($UserModel);

	$borrowerTypes = $DropDownController->showBorrowerTypes();

	// Check if form was submitted
	if(isset($_POST['submit'])) {
		// Get form data
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$borrower_type_id = $_POST['borrower_type_id'];
		$contact_no = $_POST['contact_no'];

		
		// Call addBorrowerController function
		$result = $AddBorrowerController->addBorrowerController($firstname, $lastname, $email, $password, $confirm_password, $borrower_type_id, $contact_no);

		// Check if the form submission was successful
		if ($result[0] == true) {
			// Show the success message and set the alert type
			$message = $result[1];
			$alert_type = "alert-success";
		} else {
			// Show the error message
			$message = $result[1];
			$alert_type = "alert-danger";
		}
	}
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
			<div id="liveAlertPlaceholder">
				<?php if (isset($message)) { ?>
					<div class="alert <?php echo $alert_type; ?> alert-dismissible" role="alert">
                        <div><?php echo $message ?></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
				<?php
				}	
				?>
			</div>
			<div class="form-container">
				<form action="" method="POST">
					<div class="row">
						<div class="col-lg-6 col-sm-12 mb-3">
							<label for="firstname" class="col-form-label fw-semibold">First Name</label>
							<input type="text" class="form-control form-control-lg" id="firstname" name="firstname" placeholder="Enter First Name">
						</div>

						<div class="col-lg-6 col-sm-12 mb-3">
							<label for="lastname" class="col-form-label fw-semibold">Last Name</label>
							<input type="text" class="form-control form-control-lg" id="lastname" name="lastname" placeholder="Enter Last Name">
						</div>
					</div>

					<div class="panel mb-3">
						<label for="borrower-type" class="col-form-label fw-semibold">Borrower Type:</label>
						<select class="form-select form-select-lg mb-3" name="borrower_type_id" id="borrower_type_id" onchange="changeContent()">
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
						<input type="tel" class="form-control form-control-lg" id="contact_no" name="contact_no" pattern="[0-9]{11}" placeholder="Enter Phone Number">
					</div>

					<div class="panel mb-3">
						<label for="email" class="col-form-label fw-semibold">Email</label>
						<input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter Email">
					</div>

					<div class="panel mb-3">
						<label for="password" class="col col-form-label fw-semibold">Password  
							<span 
							data-bs-toggle="tooltip"
							data-bs-custom-class="custom-tooltip"
							data-bs-title="The password is the borrower's student's / faculty's / research staff's ID">
								<i class="fa-solid fa-circle-info" style="color: #5463ff;"></i>
							</span>
						</label>
						<input type="text" class="form-control form-control-lg" id="password" name="password" placeholder="Enter Password" style="pointer-events: none;">
					</div>

					<div class="panel mb-3 passwordInput">

					</div>
					
					<label for="confirmPassword" class="col col-form-label fw-semibold">Confirm Password  
						<span 
						data-bs-toggle="tooltip"
						data-bs-custom-class="custom-tooltip"
						data-bs-title="Re-enter the password to confirm!">
							<i class="fa-solid fa-circle-info" style="color: #5463ff;"></i>
						</span>
					</label>
					<div class="input-group mb-3">
						<input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg border-2 fw-normal"placeholder="Confirm Password" aria-label="confirmPassword" aria-describedby="confirmPassword" required>
						<button class="input-group-text border-2" type="button" id="show-password"><i class="fa-solid fa-eye" id="eye-icon"></i></button>
					</div>

					<button type="submit" name="submit" id="AddAdminBtn" class="btn btn-primary bg-blue fw-semibold">Add Borrower</button>
				</form>
			</div>
		</section>
	</main>
	
	<?php include_once '../include/footer.inc.php'?>

	<script>
		function changeContent() {
			let selectBox = document.getElementById('borrower_type_id');
			let selectedValue = selectBox.options[selectBox.selectedIndex].value;
			let contentDiv = document.getElementById('additional-info-form');

			// Change the content of the div based on the selected value
			if (selectedValue == '1') {
				contentDiv.innerHTML = `<div class="panel mb-3 mb-3">
											<label for="student-id" class="col-form-label fw-semibold">Student ID</label>
											<input type="text" class="form-control form-control-lg id-number" id="student-id" name="student_id" placeholder="Enter Student's ID Number">
										</div>
										
										<div class="row">
											<div class="col-lg-6 col-sm-12 mb-3">
												<label for="course" class="col-form-label fw-semibold">Course</label> <span><small>(Ex: BS Biology)</small></span>
												<input type="text" class="form-control form-control-lg" id="course" name="course" placeholder="Enter Student's Course">
											</div>

											<div class="col-lg-6 col-sm-12 mb-3">
												<label for="yearAndBlock" class="col-form-label fw-semibold">Year and Block</label> 
												<span><small>(Ex: 4A)</small></span>
												<input type="text" class="form-control form-control-lg" id="year-block" name="year_block" placeholder="Enter Student's Year and Block">
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
												<input type="text" class="form-control form-control-lg id-number" id="faculty-id" name="faculty_id" placeholder="Enter Faculty's ID Number">
											</div>

											<div class="col-lg-6 col-sm-12 mb-3">
												<label for="faculty-department" class="col-form-label fw-semibold">Faculty's Department</label>
												<input type="text" class="form-control form-control-lg" id="faculty-department" name="department" placeholder="Enter Faculty's Department">
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
											<input type="text" class="form-control form-control-lg id-number" id="research-id" name="research_staff_id" placeholder="Enter Research Staff's ID Number">
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

        const confirmPasswordInput = document.getElementById('confirm_password');
        const showPasswordBtn = document.getElementById('show-password');


        showPasswordBtn.addEventListener('click', () => {
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                showPasswordBtn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
            } else {
                confirmPasswordInput.type = 'password';
                showPasswordBtn.innerHTML = '<i class="fa-solid fa-eye" id="eye-icon">';
            }
        })

		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
	</script>
</body>
</html>