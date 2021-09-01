<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$spcID = $_POST['spcID'];
$spcFirstName = $_POST['spcFirstName'];
$spcLastName = $_POST['spcLastName'];
$spcJobTitle = $_POST['jobTitle'];
$spcMainPhone = $_POST['spcMainPhone'];
$spcMobilePhone = $_POST['spcMobilePhone'];
$spcEmail = $_POST['spcEmail'];
$splID = $_POST['splID'];
    
//Check if empty to match phone constraint
if (empty($spcMainPhone)) {
    $spcMainPhone = null;
}


echo $spcID, " ", $spcFirstName, " ", $spcLastName, " ", $spcJobTitle, " ", $spcMainPhone, " ", $spcMobilePhone, " ", $spcEmail, " ", $splID;

//Preparing statement and binding values
$sql = $conn->prepare("INSERT INTO supplier_contact 
                     (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID)
                     VALUES 
                     (?, ?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssssss", $spcID, $spcFirstName, $spcLastName, $spcJobTitle, $spcMainPhone, $spcMobilePhone, $spcEmail, $splID);

//Execution Validation
if ($sql->execute()) {
    $success = "New Rows created successfully";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Erorr during insert process";
    header("Location: datasites.php?submitmsg='$error'");
}
?>