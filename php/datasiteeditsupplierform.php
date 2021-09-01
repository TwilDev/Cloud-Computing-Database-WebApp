
<!-- Form for editing Company Information -->
<form method="post" action="datasiteeditsupplierformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        
        //Assign company ID for update query
        $splID = $_GET['splID'];
    
        $sql = $conn->prepare("SELECT * FROM supplier_full_info_view WHERE supplier_ID LIKE ?;");
        $sql->bind_param("s",$splID);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            //echo "obtained data";
            $row = $result->fetch_assoc();
            //echo $row['server_name'];
        } else {
            echo "No Results Found";
        }
    
    ?>
<h4>Edit Data Site</h4>
<div id="contactInputFields">
        <input type="hidden" name="splID" value="<?php echo $row['supplier_ID']; ?>">
        <label>Address Line 1: </label>
        <input type="text" name="splAdrLineOne" value="<?php echo$row['address_line_1']; ?>"><br>
        <label>Address Line 2: </label>
        <input type="text" name="splAdrLineTwo" value="<?php echo$row['address_line_2']; ?>"><br>
        <label>Postcode: </label>
        <input type="text" name="splPostcode" value="<?php echo$row['postcode']; ?>"><br>
        <label>City: </label>
        <input type="text" name="splCity" value="<?php echo$row['city']; ?>"><br>
        <label>County: </label>
        <input type="text" name="splCounty" value="<?php echo$row['county']; ?>"><br>
        <label>Main Phone: </label>
        <input type="text" name="splMainPhone" value="<?php echo$row['main_phone']; ?>"><br>
        <label>Email: </label>
        <input type="text" name="splEmail" value="<?php echo$row['email']; ?>"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    </div>
</form>