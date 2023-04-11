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
	<title>Admin</title>
</head>
<body>
	<?php include_once '../include/header.inc.php'?>
		<?php include_once '../include/sidebar.inc.php'?>
				<div class="container-md form-group col-lg-6" style="padding-top: 8rem;">
				<a class="d-flex align-items-left text-black fw-bold fs-4"><i class="fa-solid fa-user-plus me-2 fs-4"></i>Add Borrower</a>

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
    					<label for="borrower_type" class="">Select borrower type</label>
    					<select type="borrower_type" class="form-control form-control-lg" id="borrower_type" placeholder="Select Borrower Type">
                        </select>
                    </div>
                    <div class="panel mb-3">
    				    <label for="contact_no" class="col-form-label">Contact No. </label>
                        <input type="tel" class="form-control form-control-lg" id="contact_no" pattern="[0-9]{10}" placeholder="Enter Contact No.">
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
</body>
<?php include_once '../include/footer.inc.php'?>
</html>