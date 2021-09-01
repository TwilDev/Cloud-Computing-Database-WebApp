<?php 

//Adding new customer
function addNewCustomer() {
    
    //Prerequisites
    require('dbconn.php');
    
    //Assign NOT NULL variables
    $cusID = $_POST['cusID'];
    $firstName = $_POST['cusFirstName'];
    $lastName = $_POST['cusLastName'];
    $adrLineOne = $_POST['cusAdrLineOne'];
    $postcode = $_POST['cusPostcode'];
    $mobilePhone = $_POST['cusMobilePhone'];
    $email = $_POST['cusEmail'];
    $adrLineTwo = $_POST['cusAdrLineTwo'];
    $city = $_POST['cusCity'];
    $county = $_POST['cusCounty'];
    $mainPhone = $_POST['cusMainPhone'];
    
    //Check if empty to match phone constraint
    if (empty($mainPhone)) {
        $mainPhone = null;
    } 

    //Preparing statement and binding values
    $stmt = $conn->prepare("INSERT INTO customer 
                            (customer_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $cusID, $firstName, $lastName, $adrLineOne, $adrLineTwo, $postcode, $city, $county, $mainPhone, $mobilePhone, $email);
    
    //Validiation for successful execution
    if ($stmt->execute()) {
        $success = "New Rows created successfully";
        header("Location: onlineplans.php?submitmsg='$success'");
    } else {
        $error = "Error during creation process please check inputs";
        header("Location: onlineplans.php?submitmsg='$error'");
    }
    
    $conn->close();
}


//Adding new company
function addNewCompanyWithContact() {
    
    //Prerequisites
    require('dbconn.php');
    
    //Assign variables
    $cpyID = $_POST['cpyID'];
    $companyName = $_POST['companyName'];
    $cpyAdrLineOne = $_POST['cpyAdrLineOne'];
    $cpyAdrLineTwo = $_POST['cpyAdrLineTwo'];
    $cpyPostcode = $_POST['cpyPostcode'];
    $cpyCity = $_POST['cpyCity'];
    $cpyCounty = $_POST['cpyCounty'];
    $cpyMainPhone = $_POST['cpyMainPhone'];
    $cpyMobilePhone = $_POST['cpyMobilePhone'];
    $cpyEmail = $_POST['cpyEmail'];
    
    //Check if empty to match phone constraint
    if (empty($cpyMainPhone)) {
        $cpyMainPhone = null;
    } 
    
    if (empty($cpyMobilePhone)) {
        $cpyMobilePhone = null;
    }

    //Preparing statement and binding values
    $stmt = $conn->prepare("INSERT INTO company
                            (company_ID, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $cpyID, $companyName, $cpyAdrLineOne, $cpyAdrLineTwo, $cpyPostcode, $cpyCity, $cpyCounty, $cpyMainPhone, $cpyMobilePhone, $cpyEmail);
    
    //Validiation for successful execution
    if (!$stmt->execute()) {
        $error = "Error during creation process please check inputs";
        header("Location: onlineplans.php?submitmsg='$error'");
    } 
    
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
    
    //Preparing statement and binding values
    $stmt = $conn->prepare("INSERT INTO company_contact 
                            (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $conID, $conFirstName, $conLastName,  $conAdrLineOne, $conAdrLineTwo, $conPostcode, $conCity, $conCounty, $conMainPhone, $conMobilePhone, $conEmail, $cpyID);
    
    //Validiation for successful execution
    if ($stmt->execute()) {
        $success = "New Rows created successfully";
        header("Location: onlineplans.php?submitmsg='$success'");
    } else {
        $error = "Error during creation process please check inputs";
        header("Location: onlineplans.php?submitmsg='$error'");
    }
    
    
    $conn->close();
}

function addNewCompanyWithoutContact() {
        
    //Prerequisites
    require('dbconn.php');
    
    //Assign variables
    $cpyID = $_POST['cpyID'];
    $companyName = $_POST['companyName'];
    $cpyAdrLineOne = $_POST['cpyAdrLineOne'];
    $cpyAdrLineTwo = $_POST['cpyAdrLineTwo'];
    $cpyPostcode = $_POST['cpyPostcode'];
    $cpyCity = $_POST['cpyCity'];
    $cpyCounty = $_POST['cpyCounty'];
    $cpyMainPhone = $_POST['cpyMainPhone'];
    $cpyMobilePhone = $_POST['cpyMobilePhone'];
    $cpyEmail = $_POST['cpyEmail'];
    
    //Check if empty to match phone constraint
    if (empty($cpyMainPhone)) {
        $cpyMainPhone = null;
    } 
    
    //Preparing statement and binding values
    $stmt = $conn->prepare("INSERT INTO company
                            (company_ID, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $cpyID, $companyName, $cpyAdrLineOne, $cpyAdrLineTwo, $cpyPostcode, $cpyCity, $cpyCounty, $cpyMainPhone, $cpyMobilePhone, $cpyEmail);
    
    //Validiation for successful execution
    if ($stmt->execute()) {
        $success = "New Rows created successfully";
        header("Location: onlineplans.php?submitmsg='$success'");
    } else {
        $error = "Error during creation process please check inputs";
        header("Location: onlineplans.php?submitmsg='$error'");
    }
    
}


//Check client type
$clientType = $_POST['radioclID'];

//Direct to function
if ($clientType == "cusID") {
    addNewCustomer();

} else if ($clientType == "cpyID") {
    if ($_POST['radioconID'] == "conTrue") {
          addNewCompanyWithContact();
    } else {
          addNewCompanyWithoutContact();
    }
} else {
    header("Location: onlineplans.php?submitmsg?='No Client Type Selected'");
}

?>