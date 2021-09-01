
<!-- Form for editing Company Information -->
<form method="post" action="datasiteeditformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        
        //Assign company ID for update query
        $dsID = $_GET['dsID'];
    
        $sql = $conn->prepare("SELECT * FROM data_site_full_info_view WHERE data_site_ID LIKE ?;");
        $sql->bind_param("s",$dsID);
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
        <input type="hidden" name="dsID" value="<?php echo$row['data_site_ID']; ?>">
        <label>Address Line 1: </label>
        <input type="text" name="dsAdrLineOne" value="<?php echo$row['address_line_1']; ?>"><br>
        <label>Address Line 2: </label>
        <input type="text" name="dsAdrLineTwo" value="<?php echo$row['address_line_2']; ?>"><br>
        <label>Postcode: </label>
        <input type="text" name="dsPostcode" value="<?php echo$row['postcode']; ?>"><br>
        <label>City: </label>
        <input type="text" name="dsCity" value="<?php echo$row['city']; ?>"><br>
        <label>County: </label>
        <input type="text" name="dsCounty" value="<?php echo$row['county']; ?>"><br>
        <label>Main Phone: </label>
        <input type="text" name="dsMainPhone" value="<?php echo$row['main_phone']; ?>"><br>
        <label>Email: </label>
        <input type="text" name="dsEmail" value="<?php echo$row['email']; ?>"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    </div>
</form>