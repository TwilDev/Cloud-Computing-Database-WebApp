<!-- Form for searching for specific host server -->
<h4>Please select a Data Site</h4>

<?php
require('dbconn.php');
?>

<form method="get" action="datasitefullinfo.php">
    <?php 
        $get_make = "SELECT DISTINCT data_site_ID FROM data_site;";
        $dropdown = $conn->query($get_make);
    ?>
    <!-- Dropdown -->
    <select name="dsID">
        <?php
            while($row = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$row['data_site_ID'].'">'.$row["data_site_ID"] . '</option>';
            }
        ?>
    </select>
    <input type="submit" value="Search">
</form>
