<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$cpyID = $_POST['cpyID'];
$cpyName = $_POST['cpyName'];
$cpyAdrLineOne = $_POST['cpyAdrLineOne'];
$cpyAdrLineTwo = $_POST['cpyAdrLineTwo'];
$cpyPostcode = $_POST['cpyPostcode'];
$cpyCity = $_POST['cpyCity'];
$cpyCounty = $_POST['cpyCounty'];
$cpyMainPhone = $_POST['cpyMainPhone'];
$cpyMobilePhone = $_POST['cpyMobilePhone'];
$cpyEmail = $_POST['cpyEmail'];
    
//Check if empty to match phone constraint
if (empty($cpyMainPhone)) {
    $cpyMainPhone = null;
}

if (empty($cpyMobilePhone)) {
    $cpyMobilePhone = null;
} 

echo $cpyID, " ", $cpyName, " ", $cpyAdrLineOne, " ", $cpyAdrLineTwo, " ", $cpyPostcode, " ", $cpyCity, " ", $cpyCounty, " ", $cpyMainPhone, " ", $cpyMobilePhone, " ", $cpyEmail;

//Preparing statement and binding values
$sql = $conn->prepare("UPDATE company SET
                            company_name=?, address_line_1=?, address_line_2=?, postcode=?, city=?, county=?, main_phone=?, mobile_phone=?, email=? WHERE company_ID LIKE ?");
$sql->bind_param("ssssssssss",$cpyName, $cpyAdrLineOne, $cpyAdrLineTwo, $cpyPostcode, $cpyCity, $cpyCounty, $cpyMainPhone, $cpyMobilePhone, $cpyEmail, $cpyID);

//Execution Validation
if ($sql->execute()) {
    $success = "Update Successful";
    header("Location: onlineplans.php?submitmsg='$success'");
} else {
    $error = "Erorr during update process";
    header("Location: onlineplans.php?submitmsg='$error'");
}
?>