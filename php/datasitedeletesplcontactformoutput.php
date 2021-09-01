<?php

require('dbconn.php');

$spcID = $_GET['spcID'];
echo $spcID;

$sql = $conn->prepare("DELETE FROM supplier_contact WHERE supplier_contact_ID LIKE ?;");
$sql->bind_param("s",$spcID);

if ($sql->execute()) {
    $success = "Deleted successfully";
    header("Location: datasites.php?submitmsg='$success'");
} else {
    $error = "Error during deletion process";
    header("Location: datasites.php?submitmsg='$error'");
}


?>