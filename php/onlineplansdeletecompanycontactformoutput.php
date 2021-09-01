<?php

require('dbconn.php');

$conID = $_GET['conID'];
echo $conID;

$sql = $conn->prepare("DELETE FROM company_contact WHERE company_contact_ID LIKE ?;");
$sql->bind_param("s",$conID);

if ($sql->execute()) {
    $success = "Deleted successfully";
    header("Location: onlineplans.php?submitmsg='$success'");
} else {
    $error = "Error during deletion process";
    header("Location: onlineplans.php?submitmsg='$error'");
}


?>