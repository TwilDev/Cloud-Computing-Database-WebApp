<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$cusID = $_POST['cusID'];
$cusFirstName = $_POST['cusFirstName'];
$cusLastName = $_POST['cusLastName'];
$cusAdrLineOne = $_POST['cusAdrLineOne'];
$cusAdrLineTwo = $_POST['cusAdrLineTwo'];
$cusPostcode = $_POST['cusPostcode'];
$cusCity = $_POST['cusCity'];
$cusCounty = $_POST['cusCounty'];
$cusMainPhone = $_POST['cusMainPhone'];
$cusMobilePhone = $_POST['cusMobilePhone'];
$cusEmail = $_POST['cusEmail'];
    
//Check if empty to match phone constraint
if (empty($cusMainPhone)) {
    $cusMainPhone = null;
}


echo $cusID, " ", $cusFirstName, " ", $cusLastName, " ", $cusAdrLineOne, " ", $cusAdrLineTwo, " ", $cusPostcode, " ", $cusCity, " ", $cusCounty, " ", $cusMainPhone, " ", $cusMobilePhone, " ", $cusEmail;

//Preparing statement and binding values
$sql = $conn->prepare("UPDATE customer SET
                            first_name=?, last_name=?, address_line_1=?, address_line_2=?, postcode=?, city=?, county=?, main_phone=?, mobile_phone=?, email=? WHERE customer_ID LIKE ?");
$sql->bind_param("sssssssssss",$cusFirstName, $cusLastName, $cusAdrLineOne, $cusAdrLineTwo, $cusPostcode, $cusCity, $cusCounty, $cusMainPhone, $cusMobilePhone, $cusEmail, $cusID);

//Execution Validation
if ($sql->execute()) {
    $success = "Update Successful";
    header("Location: onlineplans.php?submitmsg='$success'");
} else {
    $error = "Erorr during update process";
    header("Location: onlineplans.php?submitmsg='$error'");
}
?>