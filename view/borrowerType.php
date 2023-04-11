<?php
    session_start();
    require_once '../config/dbConn.config.php';
    require_once '../models/dropdown-option.model.php';
    require_once '../controllers/dropdown-option.controller.php';
    
    $db = new DBConn;
    $model = new DropDownOptionModel($db);
    $controller = new DropdownOptionController($model);

    $borrowerTypes = $controller->showBorrowerTypes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../include/head.inc.php'?>
    <title>Document</title>
</head>
<body>
    <label for="borrower_type">Borrower Type:</label>
    <select class="form-select form-select-lg mb-3" name="borrower_type" id="borrower_type">
        <option selected>Select a borrower type</option>
    <?php foreach($borrowerTypes as $borrowerType): ?>
        <option value="<?php echo $borrowerType['borrower_type_id']; ?>"><?php echo $borrowerType['type_name']; ?></option>
    <?php endforeach; ?>
    </select>

    <?php include_once '../include/footer.inc.php'?>
</body>
</html>