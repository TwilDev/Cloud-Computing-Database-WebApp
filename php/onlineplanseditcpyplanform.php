<!-- Form for searching for specific host server -->
<?php 
include('header.html');
require('dbconn.php');


//Assign variable for update
$cpyID = $_GET['cpyID'];

echo "<h4>Edit Company Plan details</h4>"
?>


<form method="post" action="onlineplanseditcpyplanformoutput.php">
    <?php 
        $sql = $conn->prepare("SELECT * FROM cpy_plan_edit_form_view WHERE company_ID LIKE ?;");
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
    <input type="hidden" name="cpyID" value="<?php echo $cpyID; ?>">
    <br><label>Plan Payment Method: </label>
    <input type="text" name="paymentMethod" value="<?php echo $row['plan_payment_method'];?>" readonly>
    <label> New Paymemt Method: </label>
    <select name="cplPayment">
    <option value="Monthly">Monthly</option>
    <option value="Annual">Annual</option>
    </select><br>
    <label>Start Date: </label>
    <input type="date" name="startDate" value="<?php echo $row['start_date'];?>"><br>
    <label>End Date: </label>
    <input type="date" name="endDate" value="<?php echo $row['end_date'];?>"><br>
    

        
    <label>Current Plan: </label>
    <input type="text" value="<?php echo $row['plan_name']; ?>">
    <label>New Plan: </label>
    <?php 
        $plnInfo = "SELECT DISTINCT plan_ID, plan_name
                    FROM plan;";
        $dropdown = $conn->query($plnInfo);
    ?>
    <!-- Dropdown -->
    <select name="plnID">
        <?php
            while($plnRow = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$plnRow['plan_ID'].'">'.$plnRow["plan_name"] . '</option>';
            }
        ?>
    </select><br>
    
    
    <label>Current Operating system: </label>
    <input type="text" value="<?php echo $row['operating_system_name'] ; ?>" readonly>
    <label>New Operating system: </label>
    <?php 
        $osInfo = "SELECT DISTINCT operating_system_ID, CONCAT(name, ' ',  version) AS os_name FROM operating_system;";
        $dropdown = $conn->query($osInfo);
    ?>
    <!-- Dropdown -->
    <select name="osID">
        <?php
            while($osRow = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$osRow['operating_system_ID'].'">'.$osRow["os_name"] . '</option>';
            }
        ?>
    </select><br>
    
    
    <label>Current Host Server: </label>
    <input type="text" value="<?php echo $row['server_name']; ?>" readonly>
    <label>Host Server: </label>
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
    </select><br>
    
    <input type="submit" value="Confirm">
</form>