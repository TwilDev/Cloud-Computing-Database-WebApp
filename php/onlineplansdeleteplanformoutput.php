<?php

require('dbconn.php');

$cplID = $_GET['cplID'];
echo $cplID;

$sql = $conn->prepare("DELETE FROM chosen_plan WHERE chosen_plan_ID LIKE ?;");
$sql->bind_param("s",$cplID);

if ($sql->execute()) {
    $success = "Deleted successfully";
    header("Location: onlineplans.php?submitmsg='$success'");
} else {
    $error = "Error during deletion process";
    header("Location: onlineplans.php?submitmsg='$error'");
}

?>