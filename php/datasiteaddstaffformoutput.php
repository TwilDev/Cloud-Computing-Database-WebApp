<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$stfID = $_POST['stfID'];
$stfFirstName = $_POST['stfFirstName'];
$stfLastName = $_POST['stfLastName'];
$stfJobTitle = $_POST['jobTitle'];
$stfMainPhone = $_POST['stfMainPhone'];
$stfMobilePhone = $_POST['stfMobilePhone'];
$stfEmail = $_POST['stfEmail'];
$dsID = $_POST['dsID'];
    
//Check if empty to match phone constraint
if (empty($stfMainPhone)) {
    $stfMainPhone = null;
}


echo $stfID, " ", $stfFirstName, " ", $stfLastName, " ", $stfJobTitle, " ", $stfMainPhone, " ", $stfMobilePhone, " ", $stfEmail;

//Preparing statement and binding values
$sql = $conn->prepare("INSERT INTO staff 
                     (staff_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID)
                     VALUES 
                     (?, ?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssssss", $stfID, $stfFirstName, $stfLastName, $stfJobTitle, $stfMainPhone, $stfMobilePhone, $stfEmail, $dsID);

//Execution Validation
if ($sql->execute()) {
    $success = "New Rows created successfully";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Erorr during insert process";
    header("Location: datasites.php?submitmsg='$error'");
}
?>