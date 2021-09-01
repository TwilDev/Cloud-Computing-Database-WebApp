<!-- Form for searching company name, and customer first/last/full name -->
<form method="POST" action="onlineplanscustcompformoutput.php">
    <h4>Enter Company or Customer Name(s) to search</h4>
    <input name="searchID" type="search">
    <input type=submit value="Search">
    <input type="radio" id="cpyID" name="radioID" value="cpyID" checked="true";>
    <label for="cpyID">Company</label>
    <input type="radio" id="cusID" name="radioID" value="cusID">
    <label for="cusID">Customer</label>
</form>

<!-- Form for adding new client -->
<?php
require('dbconn.php');
?>

<h4>Add New Client</h4>

<form method="post" action="onlineplansaddnewclientform.php">
    <input type="submit" value="Add New Client">
</form>

<h4>Add New Client Plan</h4>

<form method="post" action="onlineplansaddnewonlineplanform.php">
    <input type="submit" value="Add New Customer Plan">
</form>