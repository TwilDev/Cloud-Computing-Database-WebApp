<!-- Form for adding new datasite -->
<?php 
include('header.html');
require('dbconn.php');

?>

<h4>Create New Supplier</h4>

<form method="post" action="datasiteaddsupplierformoutput.php">
    
    <h5>Enter Data Site Information</h5>
    <label>Supplier ID: </label>
    <input type="text" name="splID" maxlength="5" placeholder="SPL00"><br>
    <label>Address Line 1: </label>
    <input type="text" name="splAdrLineOne"><br>
    <label>Address Line 2: </label>
    <input type="text" name="splAdrLineTwo"><br>
    <label>Postcode: </label>
    <input type="text" name="splPostcode"><br>
    <label>City: </label>
    <input type="text" name="splCity"><br>
    <label>County: </label>
    <input type="text" name="splCounty"><br>
    <label>Main Phone: </label>
    <input type="text" name="splMainPhone"><br>
    <label>Email: </label>
    <input type="text" name="splEmail"><br>
    <label>Supplying Data Site:</label>
    <?php 
        $dsInfo = "SELECT DISTINCT data_site_ID FROM data_site;";
        $dropdown = $conn->query($dsInfo);
    ?>
    <!-- Dropdown -->
    <select name="dsID">
        <?php
            while($row = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$row['data_site_ID'].'">'.$row["data_site_ID"] . '</option>';
            }
        ?>
    </select><br>
    

    <br><input id="finalSubmit" type="submit" value="Confirm">
</form>