<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './include/head.php'?>
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
</body>
</html>

