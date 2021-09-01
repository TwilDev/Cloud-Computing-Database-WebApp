<?php
    
//Prerequisites
include('header.html');
require('dbconn.php');

$splID = $_GET['splID'];

function editSplContact() {
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
          header("Location: suppliers.php");
//        $success = "Update Successful";
//        header("Location: suppliers.php?submitmsg='$success'");
    } else {
        $error = "Erorr during update process";
        header("Location: suppliers.php?submitmsg='$error'");
    }
}


?>

<form method="post" action="suppliercontactformoutput.php">
        <?php 


        $splID = $_GET['splID'];
    
        $sql = $conn->prepare("SELECT * FROM data_site_supplier_contact_info_view WHERE contact_supplier_ID LIKE ?;");
        $sql->bind_param("s",$splID);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();;
        } else {
            echo "No Results Found";
        }
        
    ?>
<h4>Edit Contact</h4>
<div id="contactInputFields">
        <input type="hidden" name="spcID" value="<?php echo$row['supplier_contact_ID']; ?>">
        <input type="hidden" name="splID" value="<?php echo $splID; ?>">
        <label>First Name: </label>
        <input type="text" name="firstName" value="<?php echo $row['first_name']; ?>"><br>
        <label>Last Name: </label>
        <input type="text" name="lastName" value="<?php echo $row['last_name']; ?>"><br>
        <label>Job Title: </label>
        <input type="text" name="jobTitle" value="<?php echo$row['job_title']; ?>"><br>
        <label>Main Phone: </label>
        <input type="text" name="spcMainPhone" value="<?php echo$row['main_phone']; ?>"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="spcMobilePhone" value="<?php echo$row['mobile_phone']; ?>"><br>
        <label>Email: </label>
        <input type="text" name="spcEmail" value="<?php echo$row['email']; ?>"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    
        <?php
           if($_SERVER['REQUEST_METHOD']=='POST')
           {
               editSplContact();
           } 
        ?>
    </div>
</form>