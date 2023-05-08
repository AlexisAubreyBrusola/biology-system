<?php
	require_once '../include/session.inc.php';
	require_once '../config/dbConn.config.php';
	require_once '../models/dropdown-option.model.php';
	require_once '../controllers/dropdown-option.controller.php';
	require_once '../controllers/add-equipment.contoller.php';
	require_once '../models/equipment.model.php';

	$db = new DBConn;
	$DropDownModel = new DropDownOptionModel($db);
	$DropDownController = new DropdownOptionController($DropDownModel);

	$EquipmentModel = new EquipmentModel($db);
	$AddEquipmentController = new AddEquipmentController($EquipmentModel);

	// To show Equipment Categories
	$equipmentCategory = $DropDownController->showEquipmentCategory();

	if(isset($_POST['submit'])) {
		$equipmentName = $_POST['equipmentName'];
		$categoryId = $_POST['equipmentCategory'];
		$numberOfUnits = $_POST['numberOfUnit'];
		$description = $_POST['description'];
		

		$tempFileName = $_FILES['equipmentPhoto']['tmp_name'];
		$fileName = $_FILES['equipmentPhoto']['name'];
		$fileSize = $_FILES['equipmentPhoto']['size'];
		$uploadError = $_FILES['equipmentPhoto']['error'];

		// Uploaded Image file path
		$filePath = '../uploads/equipment-photos/';

		$addEquipment = $AddEquipmentController->addMultipleEquipment($equipmentName, $categoryId, $description, $fileSize, $numberOfUnits, $filePath, $tempFileName, $fileName, $uploadError);

		// Check if the form submission was successful
		if ($addEquipment[0] == true) {
			// Show the success message and set the alert type
			$message = $addEquipment[1];
			$alert_type = "alert-success";
		} else {
			// Show the error message
			$message = $addEquipment[1];
			$alert_type = "alert-danger";
		}
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../include/head.inc.php'?>
    <title>Equipment Inventory</title>
</head>
<body>
    <?php include_once '../include/header.inc.php'?>
    <main class="d-flex flex-nowrap">
        <?php include_once '../include/sidebar.inc.php'?>
        <section class="content w-100" style="margin-left: 320px; padding: 3rem 5rem">
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

			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMultipleEquipmentModal">To add multiple Equipment</button>

            <!-- Modal for multiple adding of equipment-->
			<div class="modal modal-lg fade" id="addMultipleEquipmentModal" tabindex="-1" aria-labelledby="addMultipleEquipmentModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<!-- Modal Title -->
					<div class="modal-header">
						<h1 class="modal-title fs-4 fw-semibold" id="addMultipleEquipmentModal"><i class="fa-solid fa-user-plus me-2 fs-4"></i>Add Equipment</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<!-- Modal Content -->
					<div class="modal-body fw-semibold">
						<form action="./equipment.php" method="POST" enctype="multipart/form-data">
							<div class="mb-3 form-check form-check-inline">
								<input type="radio" class="form-check-input addMultiple" id="addMultiple" name="modeOfAddingEquipment" checked>
								<label for="addMultiple" class="form-check-label">For adding multiple equipment</label>
					        </div>
							
							<div class="mb-3 form-check form-check-inline">
								<input type="radio" class="form-check-input singleAdd" id="singleAdd" name="modeOfAddingEquipment">
								<label for="singleAdd" class="form-check-label">For adding one equipment</label>
							</div>

							<div class="mb-3">
								<label for="equipmentName" class="form-label">Equipment's Name</label>
                                <input type="text" class="form-control form-control-lg equipmentName" id="equipmentName" name="equipmentName">
					        </div>
							
							<div class="mb-3">
								<label for="numberOfUnit" class="form-label numberOfUnit">Number of Unit/s</label>
                                <input type="number" class="form-control form-control-lg numberOfUnitLabel" id="numberOfUnit" name="numberOfUnit" min="1">
					        </div>
                            
                            <div class="mb-3">
								<label for="equipmentCategory" class="col-form-label fw-semibold">Equipment Category</label>
								<select class="form-select form-select-lg mb-3" name="equipmentCategory" id="equipmentCategory">
									<option selected>-- Select the equipment's category --</option>
									<?php foreach($equipmentCategory as $equipmentCategory): ?>
										<option value="<?php echo $equipmentCategory['category_id']; ?>"><?php echo $equipmentCategory['category_code'] . " - " . ucwords($equipmentCategory['category_name']); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
                            
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control form-control-lg description" id="description" name="description">
					        </div>

							<div class="mb-3">
								<label for="equipmentPhoto" class="form-label">Equipment's Photo</label>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control form-control-lg equipmentPhoto" id="equipmentPhoto" name="equipmentPhoto">
					        </div>
                </div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" name="submit" id="addEquipmentBtn" class="btn btn-primary bg-blue">Add Equipment</button>
							</div>
						</form>
					</div>
				</div>
			</div>
        </section>
    </main>
    <?php include_once '../include/footer.inc.php'?>

	<script>
		const singleAddRadio = document.getElementById('singleAdd');
		const multipleAddRadio = document.getElementById('addMultiple');

		singleAddRadio.addEventListener('click', () => {
			// get the elements to be manipulated
			const numberOfUnitField = document.querySelector('.numberOfUnit');
			const numberOfUnitLabel = document.querySelector('.numberOfUnitLabel');
			const addEquipmentBtn = document.getElementById('addEquipmentBtn');

			// hide the numberOfUnit field
			numberOfUnitField.style.display = 'none';
			numberOfUnitLabel.style.display = 'none';

			// change the text of the addEquipmentBtn
			addEquipmentBtn.textContent = 'Add Single Equipment';
		});

		multipleAddRadio.addEventListener('click', () => {
			// get the elements to be manipulated
			const numberOfUnitField = document.querySelector('.numberOfUnit');
			const numberOfUnitLabel = document.querySelector('.numberOfUnitLabel');
			const addEquipmentBtn = document.getElementById('addEquipmentBtn');

			// hide the numberOfUnit field
			numberOfUnitField.style.display = '';
			numberOfUnitLabel.style.display = '';

			// change the text of the addEquipmentBtn
			addEquipmentBtn.textContent = 'Add Equipment';
		})
	</script>
</body>
</html>