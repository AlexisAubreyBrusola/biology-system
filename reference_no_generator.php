<?php

include_once './models/equipment.model.php';
include_once './config/dbConn.config.php';

$db = new DbConn;
$SimilarEquipmentCodeModel = new EquipmentModel($db);

// To get the current Year
$current_year = date("Y");

// Extract the last 2 digits of the year
$year_code = substr($current_year, 2, 3);

// Last reference number
$last_ref_no = "23-0001";
// Get the year of the reference number
$latest_year = substr($last_ref_no, 0, 2);
// Get the counter(4 digits of the reference no) of the reference number
$latest_counter = substr($last_ref_no, 3);

// If the current year is not equal to the year of the last reference number, mag rereset yung counter(which is the 4 digits of the reference number).

/*
if ($year_code != $latest_year) {
    $counter = 0;
} else {
    $counter = intval($latest_counter) + 1;
}
*/

// shorthand ito ng if-else
$counter = ($year_code != $latest_year) ? 0 : intval($latest_counter) + 1;

// 
$counter_str = str_pad($counter, 4, '0', STR_PAD_LEFT);
$new_reference_no = $year_code. '-' . $counter_str;
$hashed_password = password_hash('A@ubrey8052000', PASSWORD_DEFAULT);

/***********************************************************************/
function generateCode($category, $year, $totalNumber, $specificNumber) {
    $categoryAbbreviation = substr($category, 0, 3); // Get the first three letters of the category
    $yearCode = substr($year, -2); // Get the last two digits of the year
    $totalNumberCode = str_pad($totalNumber, 2, "0", STR_PAD_LEFT); // Ensure the total number is two digits with leading zeros if necessary
    $specificNumberCode = str_pad($specificNumber, 2, "0", STR_PAD_LEFT); // Ensure the specific number is two digits with leading zeros if necessary
    $code = $categoryAbbreviation . "-" . $yearCode . $totalNumberCode . $specificNumberCode; // Concatenate the codes to form the unique code
    return $code;
  }

  function saveUploadedFile() {
    if (isset($_FILES['uploadedPhoto'])) {
        $fileName = $_FILES['uploadedPhoto']['name'];
        // Do something with the filename here
        return $fileName;
    }
    return null;
  }

  
  $filePath = './uploads/';
  function formattedSize($size) {
    $sizeInKB = $size/1024;
    $formattedSize = number_format($sizeInKB, 2);

    if($formattedSize > 10) {
        return [$formattedSize, "Shit, your file's too big my guy!"];
    } else {
        return $formattedSize;
    }
  }

  $size = formattedSize($_FILES['uploadedPhoto']['size']);

  $tempFile = $_FILES['uploadedPhoto']['tmp_name'];

  function saveUploadedFileToFolder($filePath, $tempFile) {
    if(!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
        return "This $filePath doesn't exists my guy. I'ma make it for you!";
    } elseif(empty($tempFile)) {
        return "You just submitted a blank my guy. Come on now, THINK!!!!";
    } else {
        $filePath = $filePath . "/" . $_FILES['uploadedPhoto']['name'];
        if(move_uploaded_file($tempFile, $filePath)) {
            return "Success. the uploaded file is in the folder!";
        } else {
            return "Error!";
        }
    }
  }

  $newFileName = "\Th!s str!ng h@s spEciaL\ \ch@r@c-te../rs.jpg"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './include/head.inc.php'?>
    <title>Code Generator</title>
</head>
<body>
    <p class="fs-3 fw-semibold">Current year: <b><?php echo $current_year?></b></p>
    <p class="fs-3 fw-semibold">Last reference number: <b><?php echo $last_ref_no?></b></p>
    <p class="fs-3 fw-semibold">Year of the last reference number: <b><?php echo $latest_year?></b></p>
    <p class="fs-3 fw-semibold">Counter of the last reference number: <b><?php echo $latest_counter?></b></p>
    <p class="fs-3 fw-semibold">Counter: <b><?php echo $counter?></b></p>
    <p class="fs-3 fw-semibold">Next counter to be generated is: <b><?php echo $counter_str?></b></p>
    <p class="fs-3 fw-semibold">Next reference number to be generated: <b><?php echo $new_reference_no?></b></p>
    <p class="fs-3 fw-semibold">Hashed password:  <b><?php echo $hashed_password?></b></p>
    <p class="fs-3 fw-semibold">Generated Code:  <b><?php echo generateCode('MSC', '2023', 10, 1)?></b></p>

    <div>
        <form action="./reference_no_generator.php" method="post" enctype="multipart/form-data">
            <label for="uploadPhoto">Upload photo:</label>
            <input type="file" name="uploadedPhoto" id="uploadedPhoto" accept=".png, .jpg, .jpeg">

            <input type="submit" value="Upload" name="submmit">
        </form>
    </div>

    <p class="fs-3 fw-semibold">Uploaded file name: <b>
        <?php 
            $fileName = saveUploadedFile();
            if($fileName !== null) {
                echo $fileName;
                // print_r($_FILES); //to display the description of the uploaded file
            } 
        ?>
    </b></p>

    <p class="fs-3 fw-semibold">Size of Uploaded File: <b><?php echo $size[0] . ' ' . $size[1];?></b></p>
    <p class="fs-3 fw-semibold">Upload Message: <b><?php echo saveUploadedFileToFolder($filePath, $tempFile);?></b></p>
    <p class="fs-3 fw-semibold">Upload Message: <b><?php echo str_replace(array('\\', '/', ' ', ':', '|', '*', '<', '>', '?', '"'), '', strtolower($newFileName));?></b></p>

    <?php include_once './include/footer.inc.php'?>
</body>
</html>

