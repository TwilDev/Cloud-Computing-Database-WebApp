
<!-- Form for editing Customer information -->
<form method="post" action="onlineplanseditcustomerformoutput.php">
        <?php 
    
        //Prerequisites
        include('header.html');
        require('dbconn.php');
        
        //Assign company ID for update query
        $cusID = $_GET['cusID'];
    
        $sql = $conn->prepare("SELECT * FROM customer_info_view WHERE customer_ID LIKE ?;");
        $sql->bind_param("s",$cusID);
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
<h4>Edit Customer</h4>
<div id="contactInputFields">
        <input type="hidden" name="cusID" value="<?php echo$row['customer_ID']; ?>">
        <label>First Name: </label>
        <input type="text" name="cusFirstName" value="<?php echo$row['first_name']; ?>"><br>
        <label>Last Name: </label>
        <input type="text" name="cusLastName" value="<?php echo$row['last_name']; ?>"><br>
        <label>Address Line 1: </label>
        <input type="text" name="cusAdrLineOne" value="<?php echo$row['address_line_1']; ?>"><br>
        <label>Address Line 2: </label>
        <input type="text" name="cusAdrLineTwo" value="<?php echo$row['address_line_2']; ?>"><br>
        <label>Postcode: </label>
        <input type="text" name="cusPostcode" value="<?php echo$row['postcode']; ?>"><br>
        <label>City: </label>
        <input type="text" name="cusCity" value="<?php echo$row['city']; ?>"><br>
        <label>County: </label>
        <input type="text" name="cusCounty" value="<?php echo$row['county']; ?>"><br>
        <label>Main Phone: </label>
        <input type="text" name="cusMainPhone" value="<?php echo$row['main_phone']; ?>"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="cusMobilePhone" value="<?php echo$row['mobile_phone']; ?>"><br>
        <label>Email: </label>
        <input type="text" name="cusEmail" value="<?php echo$row['email']; ?>"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
    </div>
</form>