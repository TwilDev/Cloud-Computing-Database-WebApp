<?php 




function addNewCustomerPlan() {
    
    //Prerequisites
    require('dbconn.php');
    
    
    //Assign Variables
    $chosenPlanID = $_POST['cplID'];
    $paymentMethod = $_POST['cplPayment'];
    $virtualServer = $_POST['cplVM'];
    $startDate = $_POST['cplStartDate'];
    $endDate = $_POST['cplEndDate'];
    $operatingSystem = $_POST['osID'];
    $planID = $_POST['plnID'];
    $cusID = $_POST['cusID'];
    $hostServer = $_POST['hsID'];
    
    echo $chosenPlanID, " ", $paymentMethod, " ", $virtualServer, " ", $startDate, " ", $endDate, " ", $operatingSystem, " ", $planID, " ", $cusID, " ", $hostServer;
    
    //Preparing statement and binding variables
    $stmt = $conn->prepare("INSERT INTO chosen_plan
                            (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, server_name)
                            VALUES 
                            (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $chosenPlanID, $paymentMethod, $virtualServer, $startDate, $endDate, $operatingSystem, $planID, $cusID, $hostServer);
    
    //Validation for successful execution
    if ($stmt->execute()) {
        $conn->close();
        $success = "New Rows created successfully";
        header("Location: onlineplans.php?submitmsg='$success'");
    } else {
        $conn->close();
        $error = "Error during creation process please check inputs";
        header("Location: onlineplans.php?submitmsg='$error'");
    }
    
}

function addNewCompanyPlan() {
    
    //Prerequisites
    require('dbconn.php');
    
    //Assign Variables
    $chosenPlanID = $_POST['cplID'];
    $paymentMethod = $_POST['cplPayment'];
    $virtualServer = $_POST['cplVM'];
    $startDate = $_POST['cplStartDate'];
    $endDate = $_POST['cplEndDate'];
    $operatingSystem = $_POST['osID'];
    $planID = $_POST['plnID'];
    $cpyID = $_POST['cpyID'];
    $hostServer = $_POST['hsID'];
    
    //Preparing statement and binding variables
    $stmt = $conn->prepare("INSERT INTO chosen_plan
                            (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, company_ID, server_name)
                            VALUES 
                            (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $chosenPlanID, $paymentMethod, $virtualServer, $startDate, $endDate, $operatingSystem, $planID, $cpyID, $hostServer);
    
    //Validation for successful execution
    if ($stmt->execute()) {
        $conn->close();
        $success = "New Rows created successfully";
        header("Location: onlineplans.php?submitmsg='$success'");
    } else {
        $conn->close();
        $error = "Error during creation process please check inputs";
        header("Location: onlineplans.php?submitmsg='$error'");
    }
    
}


//Check client type
$clientType = $_POST['radioclID'];

//Direct to function
if ($clientType == "cusType") {
    addNewCustomerPlan();

} else if ($clientType == "cpyType") {
    addNewCompanyPlan();

} else {
    header("Location: onlineplans.php?submitmsg?='No Client Type Selected'");
}



?>