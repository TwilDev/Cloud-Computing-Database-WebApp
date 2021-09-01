<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$splID = $_POST['splID'];
$splAdrLineOne = $_POST['splAdrLineOne'];
$splAdrLineTwo = $_POST['splAdrLineTwo'];
$splPostcode = $_POST['splPostcode'];
$splCity = $_POST['splCity'];
$splCounty = $_POST['splCounty'];
$splMainPhone = $_POST['splMainPhone'];
$splEmail = $_POST['splEmail'];
    
//Check if empty to match phone constraint
if (empty($splMainPhone)) {
    $splMainPhone = null;
}


echo $splID, " ", $splAdrLineOne, " ", $splAdrLineTwo, " ", $splPostcode, " ", $splCity, " ", $splCounty, " ", $splMainPhone, " ", $splEmail;

//Preparing statement and binding values
$sql = $conn->prepare("UPDATE hardware_supplier SET
                            address_line_1=?, address_line_2=?, postcode=?, city=?, county=?, main_phone=?, email=? WHERE supplier_ID LIKE ?");
$sql->bind_param("ssssssss", $splAdrLineOne, $splAdrLineTwo, $splPostcode, $splCity, $splCounty, $splMainPhone, $splEmail, $splID);

//Execution Validation
if ($sql->execute()) {
    $success = "Update Successful";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Erorr during update process";
    header("Location: datasites.php?submitmsg='$error'");
}
?>