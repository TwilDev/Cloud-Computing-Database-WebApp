<?php

require('dbconn.php');

$bID = $_GET['bID'];

$sql = $conn->prepare("DELETE FROM backup WHERE backup_ID LIKE ?;");
$sql->bind_param("s",$bID);

if ($sql->execute()) {
    $success = "Deleted successfully";
    header("Location: backups.php?submitmsg='$success'");
} else {
    $error = "Error during deletion process";
    header("Location: backups.php?submitmsg='$error'");
}


?>