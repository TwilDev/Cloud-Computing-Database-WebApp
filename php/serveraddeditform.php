<!-- Form for adding new host server -->
<?php 
include('header.html');
require('dbconn.php');
    
    //Initialize variables
    $serverName = '';
    $vServerNum = '';
    $serverCores= '';
    $serverRAM = '';
    $serverStorage = '';
    $dsID = '';

if (isset($_POST['operationType'])) {
    echo "<h4>Create New Server</h4>";
} else {
    echo "<h4>Edit Server</h4>";
    
    $svhID = $_GET['svhID'];
    
    $sql = $conn->prepare("CALL specific_server_sp(?);");
    $sql->bind_param("s",$svhID);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        //echo "obtained data";
        $row = $result->fetch_assoc();
        
        //Assign variables if data retrieved
        $serverName = $row['server_name'];
//        $vServerNum = $row['virtual_server_num'];
        $serverCores = $row['server_cores'];
        $serverRAM = $row['server_ram'];
        $serverStorage = $row['server_storage'];
        $dsID = $row['data_site_ID'];
        
        
        //echo $row['server_name'];
    } else {
        echo "No Results Found";
    }
    
    
   
}
?>

<!-- Form -->
<?php 
require('dbconn.php');

?>

<form method="post" action="serveraddeditformoutput.php">
    <br><label>Server Name: </label>
    <input type="text" name="serverName" maxlength="6" placeholder="SVHXXX" value="<?php echo $serverName; ?>"><br>
<!--
    <label>Virtual Server Num: </label>
    <input type="text" name="virtualServerNum" value="<?php //echo $vServerNum; ?>"><br>
-->
    <label>Server Cores: </label>
    <input type="text" name="serverCores" value="<?php echo $serverCores ?>"><br>
    <label>Server RAM: </label>
    <input type="text" name="serverRam" value="<?php echo $serverRAM; ?>"><br>
    <label>Server Storage: </label>
    <input type="text" name="serverStorage" value="<?php echo $serverStorage; ?>"><br>
    <label>Data Site ID: </label>
    <?php 
        $dsInfo = "SELECT DISTINCT data_site_ID FROM data_site;";
        $dropdown = $conn->query($dsInfo);
    ?>
    <!-- Dropdown -->
    <select name="dsID">
        <?php
            echo '
                <option value="'. $dsID .'" selected>'. $dsID .'</option>
            
            ';
            while($row = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$row['data_site_ID'].'">'.$row["data_site_ID"] . '</option>';
            }
        ?>
    </select><br>
    <?php 
        if (isset($_POST['operationType'])) {
            echo "<input type='hidden' name='operationType' value='add'";
        }
    ?>
    <br><input type="submit" value="Confirm">
</form>