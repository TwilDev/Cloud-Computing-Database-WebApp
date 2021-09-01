<?php

require('dbconn.php');

$cpyID = $_GET['cpyID'];
echo $cpyID;

$sql = $conn->prepare("DELETE FROM chosen_plan WHERE company_ID LIKE ?;");
$sql->bind_param("s",$cpyID);

if (!$sql->execute()) {
    $error = "Error during deletion plan process";
    header("Location: backups.php?submitmsg='$error'");
} 

$sql = $conn->prepare("DELETE FROM company_contact WHERE company_ID LIKE ?");
$sql->bind_param("s",$cpyID);

if (!$sql->execute()) {
    $error = "Error during deletion contact process";
    header("Location: onlineplans.php?submitmsg='$error'");
}

$sql = $conn->prepare("DELETE FROM company WHERE company_ID LIKE ?;");
$sql->bind_param("s",$cpyID);

if ($sql->execute()) {
    $success = "Deleted successfully";
    header("Location: onlineplans.php?submitmsg='$success'");
} else {
    $error = "Error during deletion company process";
    header("Location: onlineplans.php?submitmsg='$error'");
}


?>