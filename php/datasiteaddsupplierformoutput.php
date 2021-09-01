<?php
//Prerequisites
require('dbconn.php');

//Assign variables
$splID = $_POST['splID'];
$splAdrLineOne = $_POST['splAdrLineOne'];
$splAdrLineTwo = $_POST['splAdrLineTwo'];
$splPostcode = $_POST['splPostcode'];
$splCity = $_POST['splCity'];
$splCounty = $_POST['splCounty'];
$splMainPhone = $_POST['splMainPhone'];
$splEmail = $_POST['splEmail'];
$dsID = $_POST['dsID'];

echo $splID, " adr1: ", $splAdrLineOne, " adr2: ", $splAdrLineTwo, " postcode: ", $splPostcode, " city: ", $splCity, " county: ", $splCounty, " mainphone: ", $splMainPhone, " email: ", $splEmail, " ", $dsID; 

//Check if empty to match phone constraint
if (empty($splMainPhone)) {
    $splMainPhone = null;
} 

//Preparing statement and binding values

$stmt = $conn->prepare("INSERT INTO hardware_supplier
                        (supplier_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email, data_site_ID)
                        VALUES 
                        (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $splID, $splAdrLineOne, $splAdrLineTwo, $splPostcode, $splCity, $splCounty, $splMainPhone, $splEmail, $dsID);

//Validiation for successful execution
if ($stmt->execute()) {
    $conn->close();
    $success = "New Rows created successfully";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $conn->close();
    $error = "Error during creation process please check inputs";
    header("Location: datasites.php?submitmsg='$error'");
}





?>