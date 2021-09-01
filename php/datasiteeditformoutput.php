<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$dsID = $_POST['dsID'];
$dsAdrLineOne = $_POST['dsAdrLineOne'];
$dsAdrLineTwo = $_POST['dsAdrLineTwo'];
$dsPostcode = $_POST['dsPostcode'];
$dsCity = $_POST['dsCity'];
$dsCounty = $_POST['dsCounty'];
$dsMainPhone = $_POST['dsMainPhone'];
$dsEmail = $_POST['dsEmail'];
    
//Check if empty to match phone constraint
if (empty($dsMainPhone)) {
    $dsMainPhone = null;
}


echo $dsID, " ", $dsAdrLineOne, " ", $dsAdrLineTwo, " ", $dsPostcode, " ", $dsCity, " ", $dsCounty, " ", $dsMainPhone, " ", $dsEmail;

//Preparing statement and binding values
$sql = $conn->prepare("UPDATE data_site SET
                            address_line_1=?, address_line_2=?, postcode=?, city=?, county=?, main_phone=?, email=? WHERE data_site_ID LIKE ?");
$sql->bind_param("ssssssss", $dsAdrLineOne, $dsAdrLineTwo, $dsPostcode, $dsCity, $dsCounty, $dsMainPhone, $dsEmail, $dsID);

//Execution Validation
if ($sql->execute()) {
    $success = "Update Successful";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Erorr during update process";
    header("Location: datasites.php?submitmsg='$error'");
}
?>