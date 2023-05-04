<?php
	session_start();
	require_once '../config/dbConn.config.php';
	require_once '../models/chemical.model.php';
	require_once '../controllers/add-chemical.controller.php';

	$db = new DbConn;
	$chemicalModel = new ChemicalModel($db);
	$AddChemicalController = new AddChemicalController($chemicalModel);

	if(isset($_POST['submit'])) {
		$chemicalName = $_POST['chemicalName'];
		$container = $_POST['containerNumber'];
		$containerMaxQuantity = $_POST['containerMaxQuantity'];
		$chemicalQuantity = $_POST['chemicalQuantity'];
		$chemicalFormula = $_POST['chemicalFormula'];
		$description = $_POST['description'];
		$expirationDate = $_POST['expirationDate'];
		$dateAcquired = $_POST['dateAcquired'];
		$tempFileName = $_FILES['chemicalImage']['tmp_name'];
		$newFileName = $_FILES['chemicalImage']['name'];
		$fileSize = $_FILES['chemicalImage']['size'];
		$uploadError = $_FILES['chemicalImage']['error'];
		$filePath = '../uploads/chemical-photos/';

		$imagePath = $AddChemicalController->getChemicalImageFilePath($fileSize, $filePath, $tempFileName, $newFileName, $uploadError);

		$addChemical = $AddChemicalController->addChemicalController($chemicalName, $container, $containerMaxQuantity, $chemicalQuantity, $description, $expirationDate, $dateAcquired, $fileSize, $imagePath, $chemicalFormula);

		// Check if the form submission was successful
		if ($addChemical[0] == true) {
			// Show the success message and set the alert type
			$message = $addChemical[1];
			$alert_type = "alert-success";
		} else {
			// Show the error message
			$message = $addChemical[1];
			$alert_type = "alert-danger";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../include/head.inc.php'?>
    <title>Chemicals</title>
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

			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChemicalModal">To add Chemical</button>

            <!-- Modal -->
			<div class="modal modal-lg fade" id="addChemicalModal" tabindex="-1" aria-labelledby="addChemicalModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<!-- Modal Title -->
					<div class="modal-header">
						<h1 class="modal-title fs-4 fw-semibold" id="addChemicalModalLabel"><i class="fa-solid fa-flask me-3 fs-4"></i>Add Chemical</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<!-- Modal Content -->
					<div class="modal-body fw-semibold">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col mb-3">
									<label for="chemicalName" class="form-label">Chemical's Name</label>
									<input type="text" class="form-control form-control-lg chemicalName" id="chemicalName" name="chemicalName">
								</div>

								<div class="col mb-3">
									<label for="containerNumber" class="form-label">Container Number</label>
									<span 
									data-bs-toggle="tooltip"
									data-bs-custom-class="custom-tooltip"
									data-bs-title="This will be the label (number) of the container where the chemical will be stored">
										<i class="fa-solid fa-circle-info" style="color: #5463ff;"></i>
									</span>
									<input type="number" class="form-control form-control-lg containerNumber" id="containerNumber" name="containerNumber" min="1">
								</div>							
							</div>

							<div class="row">
								<div class="col mb-3">
									<label for="containerMaxQuantity" class="form-label">Container's Maximum Quantity</label>
									<span 
									data-bs-toggle="tooltip"
									data-bs-custom-class="custom-tooltip"
									data-bs-title="Maximum quantity that the container can store">
										<i class="fa-solid fa-circle-info" style="color: #5463ff;"></i>
									</span>
									<div class="input-group">
										<input type="number" class="form-control form-control-lg containerMaxQuantity" id="containerMaxQuantity" name="containerMaxQuantity" min="1">
										<span class="input-group-text" id="containerMaxQuantity"><b>g/mL</b></span>
									</div>
								</div>

								<div class="col mb-3">
									<label for="chemicalQuantity" class="form-label">Chemical's Quantity</label>
									<span 
									data-bs-toggle="tooltip"
									data-bs-custom-class="custom-tooltip"
									data-bs-title="The chemical's quantity that will be stored in the container. The quantity of the chemical should be equal to the maximum quantity of its container">
										<i class="fa-solid fa-circle-info" style="color: #5463ff;"></i>
									</span>
									<div class="input-group">
										<input type="number" class="form-control form-control-lg chemicalQuantity" id="chemicalQuantity" name="chemicalQuantity" min="1">
										<span class="input-group-text" id="chemicalQuantity"><b>g/mL</b></span>
									</div>
								</div>
							</div>
                            
							<div class="mb-3">
								<label for="chemicalFormula" class="form-label">Chemical Formula</label>
                                <input type="text" class="form-control form-control-lg chemicalFormula" id="chemicalFormula" name="chemicalFormula">
					        </div>							
                            
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control form-control-lg description" id="description" name="description">
					        </div>

							<div class="mb-3">
								<label for="expirationDate" class="form-label">Expiration Date</label>
                                <input type="date" class="form-control form-control-lg expirationDate" id="expirationDate" name="expirationDate">
					        </div>
                
							<div class="mb-3">
								<label for="dateAcquired" class="form-label">Date Acquired</label>
                                <input type="date" class="form-control form-control-lg dateAcquired" id="dateAcquired" name="dateAcquired">
					        </div>

							<div class="mb-3">
								<label for="chemicalImage" class="form-label">Chemical's Image</label>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control form-control-lg chemicalImage" id="chemicalImage" name="chemicalImage">
					        </div>
                </div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" name="submit" id="addEquipmentBtn" class="btn btn-primary bg-blue">Add Chemical</button>
							</div>
						</form>
					</div>
				</div>
			</div>
        </section>
    </main>

    <?php include_once '../include/footer.inc.php'?>

	<script>
		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

		const chemicalQuantity = document.querySelector('#chemicalQuantity');
		const containerMaxQuantity = document.querySelector('#containerMaxQuantity');

		chemicalQuantity.addEventListener('input', () => {
  			if (Number(chemicalQuantity.value) > Number(containerMaxQuantity.value)) {
    			chemicalQuantity.value = containerMaxQuantity.value;
  			}
		});

	</script>
</body>
</html>