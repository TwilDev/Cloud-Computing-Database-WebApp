<?php

require('dbconn.php');

$cusID = $_GET['cusID'];
echo $cusID;

$sql = $conn->prepare("DELETE FROM chosen_plan WHERE customer_ID LIKE ?;");
$sql->bind_param("s",$cusID);

if (!$sql->execute()) {
    $error = "Error during deletion plan process";
    header("Location: backups.php?submitmsg='$error'");
} 

$sql = $conn->prepare("DELETE FROM customer WHERE customer_ID LIKE ?;");
$sql->bind_param("s",$cusID);

if ($sql->execute()) {
    $success = "Deleted successfully";
    header("Location: onlineplans.php?submitmsg='$success'");
} else {
    $error = "Error during deletion company process";
    header("Location: onlineplans.php?submitmsg='$error'");
}


?>