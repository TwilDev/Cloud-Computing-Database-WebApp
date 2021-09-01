<?php

function addNewCompanyContact() {
    
    //Prerequisites
    require('dbconn.php');

    //Assign Variables
    $conID = $_POST['conID'];
    $conFirstName = $_POST['conFirstName'];
    $conLastName = $_POST['conLastName'];
    $conAdrLineOne = $_POST['conAdrLineOne'];
    $conAdrLineTwo = $_POST['conAdrLineTwo'];
    $conPostcode = $_POST['conPostcode'];
    $conCity = $_POST['conCity'];
    $conCounty = $_POST['conCounty'];
    $conMainPhone = $_POST['conMainPhone'];
    $conMobilePhone = $_POST['conMobilePhone'];
    $conEmail = $_POST['conEmail'];
    $cpyID = $_POST['cpyID'];
    
    
    //Check if empty to match phone constraint
    if (empty($conMainPhone)) {
        $conMainPhone = null;
    } 

    echo $conID, " ", $conFirstName, " ", $conLastName, " ", $conAdrLineOne, " ", $conAdrLineTwo, " ", $conPostcode, " ", $conCity, " ", $conCounty, " ", $conMainPhone, " ", $conMobilePhone, " ", $conEmail, " ", $cpyID;

    //Preparing statement and binding values
    $sql = $conn->prepare("INSERT INTO company_contact_info_view 
                         (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID)
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssssssssss", $conID, $conFirstName, $conLastName, $conAdrLineOne, $conAdrLineTwo, $conPostcode, $conCity, $conCounty, $conMainPhone, $conMobilePhone, $conEmail, $cpyID);
    
    
    //Validiation for successful execution
    if ($sql->execute()) {
        $success = "New Rows created successfully";
        header("Location: onlineplans.php?submitmsg='$success'");
    } else {
        $error = "Error during creation process please check inputs";
        header("Location: onlineplans.php?submitmsg='$error'");
    }


    $conn->close();

}

function editCompanyContact() {
    
    //Prerequisites
    require('dbconn.php');

    //Assign Variables
    $conID = $_POST['conID'];
    $conFirstName = $_POST['conFirstName'];
    $conLastName = $_POST['conLastName'];
    $conAdrLineOne = $_POST['conAdrLineOne'];
    $conAdrLineTwo = $_POST['conAdrLineTwo'];
    $conPostcode = $_POST['conPostcode'];
    $conCity = $_POST['conCity'];
    $conCounty = $_POST['conCounty'];
    $conMainPhone = $_POST['conMainPhone'];
    $conMobilePhone = $_POST['conMobilePhone'];
    $conEmail = $_POST['conEmail'];

    //Check if empty to match phone constraint
    if (empty($conMainPhone)) {
        $conMainPhone = null;
    } 

    echo $conID, " ", $conFirstName, " ", $conLastName, " ", $conAdrLineOne, " ", $conAdrLineTwo, " ", $conPostcode, " ", $conCity, " ", $conCounty, " ", $conMainPhone, " ", $conMobilePhone, " ", $conEmail;

    //Preparing statement and binding values
    $sql = $conn->prepare("UPDATE company_contact_info_view SET
                                first_name=?, last_name=?, address_line_1=?, address_line_2=?, postcode=?, city=?, county=?, main_phone=?, mobile_phone=?, email=? WHERE company_contact_ID LIKE ?");
    $sql->bind_param("sssssssssss",$conFirstName, $conLastName,  $conAdrLineOne, $conAdrLineTwo, $conPostcode, $conCity, $conCounty, $conMainPhone, $conMobilePhone, $conEmail, $conID);

    if ($sql->execute()) {
        $success = "Update Successful";
        header("Location: onlineplans.php?submitmsg='$success'");
    } else {
        $error = "Erorr during update process";
        header("Location: onlineplans.php?submitmsg='$error'");
    }

    $conn->close();
}


//Operation select
if (isset($_POST['operationType'])) {
    echo "add";
    addNewCompanyContact();
} else {
    echo "edit";
    editCompanyContact();
}


?>