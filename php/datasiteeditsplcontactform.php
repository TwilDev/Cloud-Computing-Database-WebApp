

<form method="post" action="datasiteeditsplcontactformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        
        
    
        $spcID = $_GET['spcID'];
    
        $sql = $conn->prepare("SELECT * FROM data_site_supplier_contact_info_view WHERE supplier_contact_ID LIKE ?;");
        $sql->bind_param("s",$spcID);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "No Results Found";
        }
        
    ?>
<h4>Edit Contact</h4>
<div id="contactInputFields">
        <input type="hidden" name="spcID" value="<?php echo$row['supplier_contact_ID']; ?>">
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
    </div>
</form>