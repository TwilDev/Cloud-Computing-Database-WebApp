<form method="post" action="datasiteaddsplrcontactformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        //Retrieve associated company ID 
        $dsID = $_POST['dsID']
    ?>
<h4>Add New Supplier Contact</h4>
<div id="contactInputFields">
        <label>Supplier ID</label>
            <?php 
    
        $sql = $conn->prepare("SELECT DISTINCT supplier_ID FROM data_site_supplier_info_view
                               WHERE data_site_ID LIKE ?;");
        $sql->bind_param("s",$dsID);
        $sql->execute();
        $result = $sql->get_result();
        ?>
    <!-- Dropdown -->
        <select name="splID">
        <?php
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['supplier_ID'].'">'.$row["supplier_ID"] . '</option>';
            }
        ?>
    </select><br>
        <label>Contact ID: </label>
        <input type="text" name="spcID" placeholder="SPCXXX" maxlength="6"><br>
        <label>First Name: </label>
        <input type="text" name="spcFirstName"><br>
        <label>Last Name: </label>
        <input type="text" name="spcLastName"?><br>
        <label>Job Title: </label>
        <input type="text" name="jobTitle"><br>
        <label>Main Phone: </label>
        <input type="text" name="spcMainPhone"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="spcMobilePhone"><br>
        <label>Email: </label>
        <input type="text" name="spcEmail"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    </div>
</form>