<?php 
//Prerequisites
require('dbconn.php');

//Assign Variables
$stfID = $_POST['stfID'];
$stfFirstName = $_POST['firstName'];
$stfLastName = $_POST['lastName'];
$stfJobTitle = $_POST['jobTitle'];
$stfMainPhone = $_POST['stfMainPhone'];
$stfMobilePhone = $_POST['stfMobilePhone'];
$stfEmail = $_POST['stfEmail'];
    
//Check if empty to match trigger constraint
if (empty($stfMainPhone)) {
    $stfMainPhone = null;
}

if (empty($stfMobilePhone)) {
    $stfMobilePhone = null;
}

if (empty($stfEmail)) {
    $stfEmail = null;
}


echo $stfID, " ", $stfFirstName, " ", $stfLastName, " ", $stfJobTitle, " ", $stfMainPhone, " ", $stfMobilePhone, " ", $stfEmail;

//Preparing statement and binding values
$sql = $conn->prepare("UPDATE staff SET
                            first_name=?, last_name=?, job_title=?, main_phone=?, mobile_phone=?, email=? WHERE staff_ID LIKE ?");
$sql->bind_param("sssssss",$stfFirstName, $stfLastName, $stfJobTitle, $stfMainPhone, $stfMobilePhone, $stfEmail, $stfID);

////Execution Validation
if ($sql->execute()) {
    $success = "Update Successful";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Erorr during update process";
    header("Location: datasites.php?submitmsg='$error'");
}
?>