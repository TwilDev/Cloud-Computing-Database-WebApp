

<form method="post" action="datasiteeditstaffformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        
        
    
        $stfID = $_GET['stfID'];
    
        $sql = $conn->prepare("SELECT * FROM staff_full_info_view WHERE staff_ID LIKE ?;");
        $sql->bind_param("s",$stfID);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            //echo "obtained data";
            $row = $result->fetch_assoc();
            //echo $row['server_name'];
        } else {
            echo "No Results Found";
        }
        
        //Split name at space
        $names = $row['name'];
        $nameArr = explode(" ",$names);
    ?>
<h4>Edit Contact</h4>
<div id="contactInputFields">
        <input type="hidden" name="stfID" value="<?php echo$row['staff_ID']; ?>">
        <label>First Name: </label>
        <input type="text" name="firstName" value="<?php echo $nameArr[0]; ?>"><br>
        <label>Last Name: </label>
        <input type="text" name="lastName" value="<?php echo $nameArr[1]; ?>"><br>
        <label>Job Title: </label>
        <input type="text" name="jobTitle" value="<?php echo$row['job_title']; ?>"><br>
        <label>Main Phone: </label>
        <input type="text" name="stfMainPhone" value="<?php echo$row['main_phone']; ?>"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="stfMobilePhone" value="<?php echo$row['mobile_phone']; ?>"><br>
        <label>Email: </label>
        <input type="text" name="stfEmail" value="<?php echo$row['email']; ?>"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    </div>
</form>