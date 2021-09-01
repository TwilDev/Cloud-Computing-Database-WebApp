<?php 

require('dbconn.php');

//Assign input values to variables
$cusID = $_POST['cusID'];
$paymentMethod = $_POST['cplPayment'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$plnID = $_POST['plnID'];
$osID = $_POST['osID'];
$hsID = $_POST['hsID'];

echo $cusID, " ", $paymentMethod, " ", $startDate, " ", $endDate, " ", $plnID, " ", $osID, " ", $hsID;

//Prepare statment
$sql = $conn->prepare("UPDATE chosen_plan SET plan_payment_method=?, start_date=?, end_date=?, plan_ID=?, operating_system_ID=?, server_name=? WHERE customer_ID LIKE ?;");
$sql->bind_param("sssssss", $paymentMethod, $startDate, $endDate, $plnID, $osID, $hsID, $cusID);

if ($sql->execute()) {
    $success = "Update Successful";
    header("Location: onlineplans.php?submitmsg='$success'");
} else {
    $error = "Erorr during update process";
    header("Location: onlineplans.php?submitmsg='$error'");
}

$conn->close();


?>