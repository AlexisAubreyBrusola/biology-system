<?php
	require_once '../include/session.inc.php';
	require_once '../config/dbConn.config.php';
	require_once '../models/dropdown-option.model.php';
	require_once '../controllers/dropdown-option.controller.php';

	$db = new DBConn;
	$DropDownModel = new DropDownOptionModel($db);
	$DropDownController = new DropdownOptionController($DropDownModel);

	// To show Equipment Categories
	$equipmentCategory = $DropDownController->showEquipmentCategory();
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

			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">To add equipment</button>

            <!-- Modal -->
			<div class="modal modal-lg fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="addEquipmentModal" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<!-- Modal Title -->
					<div class="modal-header">
						<h1 class="modal-title fs-4 fw-semibold" id="addEquipmentModalLabel"><i class="fa-solid fa-user-plus me-2 fs-4"></i>Add Equipment</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<!-- Modal Content -->
					<div class="modal-body fw-semibold">
						<form action="./admin.php" method="POST" enctype="multipart/form-data">
							<div class="mb-3">
								<label for="equipmentName" class="form-label">Equipment's Name</label>
                                <input type="text" class="form-control form-control-lg equipmentName" id="equipmentName" name="equipmentName">
					        </div>
							
							<div class="mb-3">
								<label for="numberOfUnit" class="form-label">Number of Unit/s</label>
                                <input type="number" class="form-control form-control-lg numberOfUnit" id="numberOfUnit" name="numberOfUnit" min="1">
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
</body>
</html>