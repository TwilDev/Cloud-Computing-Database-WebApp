
<!-- Form for adding new staff memebers -->
<form method="post" action="datasiteaddstaffformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        //Retrieve associated company ID
        $dsID = $_POST['dsID'];   
    ?>
<h4>Add New Contact for <?php echo $dsID ?></h4>
<div id="contactInputFields">
        <label>Staff ID: </label>
        <input type="text" name="stfID" placeholder="STXXX" maxlength="5"><br>
        <label>First Name: </label>
        <input type="text" name="stfFirstName"><br>
        <label>Last Name: </label>
        <input type="text" name="stfLastName"?><br>
        <label>Job Title: </label>
        <input type="text" name="jobTitle"><br>
        <label>Main Phone: </label>
        <input type="text" name="stfMainPhone"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="stfMobilePhone"><br>
        <label>Email: </label>
        <input type="text" name="stfEmail"><br>
        <!--adding associated company ID-->
        <input type="hidden" name="dsID" value="<?php echo $dsID; ?>">
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    </div>
</form>