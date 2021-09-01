
<!-- Form for searching for specific host server -->
<h4>Please select a Server</h4>

<?php
require('dbconn.php');
?>

<form method="post" action="serversformoutput.php">
    <?php 
        $svhInfo = "SELECT DISTINCT server_name FROM host_server;";
        $dropdown = $conn->query($svhInfo);
    ?>
    <!-- Dropdown -->
    <select name="hsID">
        <?php
            while($row = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$row['server_name'].'">'.$row["server_name"] . '</option>';
            }
        ?>
    </select>
    <input type="submit" value="Search">
</form>

<!-- Form for adding new server -->
<?php
require('dbconn.php');
?>

<form method="post" action="serveraddeditform.php">
    <input type="hidden" value="add" name="operationType">
    <input type="submit" value="Add New">
</form>