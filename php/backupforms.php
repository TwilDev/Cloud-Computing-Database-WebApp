<!-- Form for searching for backups within a given date -->
<form method="POST" action="backupdateformoutput.php">
    <h4>Enter Dates to search for Backup</h4>
    <label>Start Date</label>
    <input name="start_date" type="date">
    <label>End Date</label>
    <input name="end_date" type="date">
    <input type=submit value="Search">
</form>

<!-- Form for adding new Backup -->
<?php
require('dbconn.php');
?>




