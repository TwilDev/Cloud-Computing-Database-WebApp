    <?php
    require('dbconn.php');

    //Assign Variables
    $spcID = $_POST['spcID'];
    $spcFirstName = $_POST['firstName'];
    $spcLastName = $_POST['lastName'];
    $spcJobTitle = $_POST['jobTitle'];
    $spcMainPhone = $_POST['spcMainPhone'];
    $spcMobilePhone = $_POST['spcMobilePhone'];
    $spcEmail = $_POST['spcEmail'];

    //Check if empty to match phone constraint
    if (empty($spcMainPhone)) {
        $stfMainPhone = null;
    }
    
    if (empty($spcMobilePhone)) {
        $stfMobilePhone = null;
    }
    
    if (empty($spcEmailPhone)) {
        $stfEmailPhone = null;
    }


    //Preparing statement and binding values
    $sql = $conn->prepare("UPDATE supplier_contact SET
                            first_name=?, last_name=?, job_title=?, main_phone=?, mobile_phone=?, email=? WHERE supplier_contact_ID LIKE ?");
    $sql->bind_param("sssssss", $spcFirstName, $spcLastName, $spcJobTitle, $spcMainPhone, $spcMobilePhone, $spcEmail, $spcID);
    
    if ($sql->execute()) {
        $success = "Update Successful";
        header("Location: suppliers.php?submitmsg='$success'");
    } else {
        $error = "Erorr during update process";
        header("Location: suppliers.php?submitmsg='$error'");
    }
$conn->close();

?>