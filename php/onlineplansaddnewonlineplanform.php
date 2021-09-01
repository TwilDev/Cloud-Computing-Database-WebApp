<!-- Form for adding new online plan -->
<?php 
include('header.html');
require('dbconn.php');

?>

<h4>Add New Client Plan</h4>

<form method="post" action="onlineplansaddclientplanformoutput.php">

<!--  Initial client type selection  -->
    <h5>Choose Client Type</h5>
    <input type="radio" id="cpyRadio" name="radioclID" value="cpyType" onCLick="toggleClientType()">
    <label for="cpyRadio">Company</label>
    <input type="radio" id="cusRadio" name="radioclID" value="cusType" onCLick="toggleClientType()">
    <label for="cusRadio">Customer</label><br>
    
    <div id="cpySelect" style="display:none">
    
        <label>Select Company: </label>
        <?php 
            $cpyInfo = "SELECT company_ID, company_name
                        FROM company
                        GROUP BY company_ID;";
            $dropdown = $conn->query($cpyInfo);
        ?>
        <!-- Dropdown -->
        <select name="cpyID">
            <?php
                while($row = mysqli_fetch_assoc($dropdown)) {
                    echo '<option value="'.$row['company_ID'].'">'.$row["company_name"] . '</option>';
                }
            ?>
        </select><br>
    
    </div>
    
    
    <div id="cusSelect" style="display:none">
    
        <label>Select Customer </label>
        <?php 
            $cusInfo = "SELECT customer_ID, 
                        CONCAT(first_name, ' ', last_name) AS name
                        FROM customer
                        GROUP BY customer_ID;";
            $dropdown = $conn->query($cusInfo);
        ?>
        <!-- Dropdown -->
        <select name="cusID">
            <?php
                while($row = mysqli_fetch_assoc($dropdown)) {
                    echo '<option value="'.$row['customer_ID'].'">'.$row["name"] . '</option>';
                }
            ?>
        </select><br>
    
    </div>
    
    <label>Chosen Plan: </label>
    <?php 
        $plnInfo = "SELECT DISTINCT plan_ID, plan_name
                    FROM plan;";
        $dropdown = $conn->query($plnInfo);
    ?>
    <!-- Dropdown -->
    <select name="plnID">
        <?php
            while($row = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$row['plan_ID'].'">'.$row["plan_name"] . '</option>';
            }
        ?>
    </select><br>
    <label>Chosen Plan ID: </label>
    <input type="text" name="cplID" maxlength="7" placeholder="CPXXXXX"><br>
    <label>Paymemt Method: </label>
    <select name="cplPayment">
    <option value="Monthly">Monthly</option>
    <option value="Annual">Annual</option>
    </select><br>
    <label>Virtual Server: </label>
    <input type="text" name="cplVM" maxlength="5" placeholder="VMXXX"><br>
    <label>Start Date: </label>
    <input type="date" name="cplStartDate">
    <label>Ending Date: </label>
    <input type="date" name="cplEndDate"><br>
    
    <label>Operating system: </label>
    <?php 
        $osInfo = "SELECT DISTINCT operating_system_ID, CONCAT(name, ' ',  version) AS os_name FROM operating_system;";
        $dropdown = $conn->query($osInfo);
    ?>
    <!-- Dropdown -->
    <select name="osID">
        <?php
            while($row = mysqli_fetch_assoc($dropdown)) {
                echo '<option value="'.$row['operating_system_ID'].'">'.$row["os_name"] . '</option>';
            }
        ?>
    </select><br>
    
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
    
    <input id=finalSubmit type="submit" value="Confirm" style="display:none">
</form>


<!-- Basic script to show form inputs dependant on client type -->


<script type="text/javascript">

function toggleClientType() {
    if (document.getElementById('cpyRadio').checked) {
        document.getElementById('cpySelect').style.display = '';
        document.getElementById('cusSelect').style.display = 'none';
        document.getElementById('finalSubmit').style.display = '';
    } else if (document.getElementById('cusRadio').checked) {
        document.getElementById('cusSelect').style.display = '';
        document.getElementById('cpySelect').style.display = 'none';
        document.getElementById('finalSubmit').style.display = '';
    }
}


</script>
