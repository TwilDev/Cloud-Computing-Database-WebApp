<!-- Form for adding new datasite -->
<?php 
include('header.html');
require('dbconn.php');

?>

<h4>Create New Data Site</h4>

<form method="post" action="datasiteaddformoutput.php">
    
    <h5>Enter Data Site Information</h5>
    <label>Data Site ID: </label>
    <input type="text" name="dsID" maxlength="5" placeholder="DS000"><br>
    <label>Address Line 1: </label>
    <input type="text" name="dsAdrLineOne"><br>
    <label>Address Line 2: </label>
    <input type="text" name="dsAdrLineTwo"><br>
    <label>Postcode: </label>
    <input type="text" name="dsPostcode"><br>
    <label>City: </label>
    <input type="text" name="dsCity"><br>
    <label>County: </label>
    <input type="text" name="dsCounty"><br>
    <label>Main Phone: </label>
    <input type="text" name="dsMainPhone"><br>
    <label>Email: </label>
    <input type="text" name="dsEmail"><br>

    <br><input id="finalSubmit" type="submit" value="Confirm">
</form>