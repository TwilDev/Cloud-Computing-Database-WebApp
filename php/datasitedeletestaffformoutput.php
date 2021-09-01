<?php

require('dbconn.php');

$stfID = $_GET['stfID'];
echo $stfID;

$sql = $conn->prepare("DELETE FROM staff WHERE staff_ID LIKE ?;");
$sql->bind_param("s",$stfID);

if ($sql->execute()) {
    $success = "Deleted successfully";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Error during deletion process";
    header("Location: datasites.php?submitmsg='$error'");
}


?>