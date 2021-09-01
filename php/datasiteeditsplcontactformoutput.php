<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$spcID = $_POST['spcID'];
$spcFirstName = $_POST['firstName'];
$spcLastName = $_POST['lastName'];
$spcJobTitle = $_POST['jobTitle'];
$spcMainPhone = $_POST['spcMainPhone'];
$spcMobilePhone = $_POST['spcMobilePhone'];
$spcEmail = $_POST['spcEmail'];
    
//Check if empty to match trigger constraint
if (empty($spcMainPhone)) {
    $spcMainPhone = null;
}

if (empty($spcMobilePhone)) {
    $spcMobilePhone = null;
}

if (empty($spcEmail)) {
    $spcEmail = null;
}


echo $spcID, " ", $spcFirstName, " ", $spcLastName, " ", $spcJobTitle, " ", $spcMainPhone, " ", $spcMobilePhone, " ", $spcEmail;

//Preparing statement and binding values
$sql = $conn->prepare("UPDATE supplier_contact SET
                            first_name=?, last_name=?, job_title=?, main_phone=?, mobile_phone=?, email=? WHERE supplier_contact_ID LIKE ?");
$sql->bind_param("sssssss",$spcFirstName, $spcLastName, $spcJobTitle, $spcMainPhone, $spcMobilePhone, $spcEmail, $spcID);

////Execution Validation
if ($sql->execute()) {
    $success = "Update Successful";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Erorr during update process";
    header("Location: datasites.php?submitmsg='$error'");
}
?>