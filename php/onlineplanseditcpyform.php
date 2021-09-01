
<!-- Form for editing Company Information -->
<form method="post" action="onlineplanseditcompanyformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        
        //Assign company ID for update query
        $cpyID = $_GET['cpyID'];
    
        $sql = $conn->prepare("SELECT * FROM company_info_view WHERE company_ID LIKE ?;");
        $sql->bind_param("s",$cpyID);
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
<h4>Edit Company</h4>
<div id="contactInputFields">
        <input type="hidden" name="cpyID" value="<?php echo$row['company_ID']; ?>">
        <label>Company Name: </label>
        <input type="text" name="cpyName" value="<?php echo$row['company_name']; ?>"><br>
        <label>Address Line 1: </label>
        <input type="text" name="cpyAdrLineOne" value="<?php echo$row['address_line_1']; ?>"><br>
        <label>Address Line 2: </label>
        <input type="text" name="cpyAdrLineTwo" value="<?php echo$row['address_line_2']; ?>"><br>
        <label>Postcode: </label>
        <input type="text" name="cpyPostcode" value="<?php echo$row['postcode']; ?>"><br>
        <label>City: </label>
        <input type="text" name="cpyCity" value="<?php echo$row['city']; ?>"><br>
        <label>County: </label>
        <input type="text" name="cpyCounty" value="<?php echo$row['county']; ?>"><br>
        <label>Main Phone: </label>
        <input type="text" name="cpyMainPhone" value="<?php echo$row['main_phone']; ?>"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="cpyMobilePhone" value="<?php echo$row['mobile_phone']; ?>"><br>
        <label>Email: </label>
        <input type="text" name="cpyEmail" value="<?php echo$row['email']; ?>"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    </div>
</form>