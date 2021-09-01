<body>
    
<?php
// Prerequisites 
include('header.html');
include('onlineplanforms.php');
require('dbconn.php');

// Check for submit message from create/edit/delete forms
if (isset($_GET['submitmsg'])) {
    echo $_GET['submitmsg'];
} 
    
echo '<h2>Company Clients</h2>';

// Calling stored procedure and assigning to result variable
$sql = "SELECT * FROM company_plan_info_view";
$result = $conn->query($sql);

// Validation for successful retrieval
if ($result->num_rows > 0) {
 echo "<div><table>
       <tr><th>Company Name</th><th>Plan Name</th><th>Start Date</th><th>End Date</th><th>Server Name</th><th>Operating System</th><th>Data Site ID</th><th>Latest Backup</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
            
            echo "<tr>
                    <td><a href='onlineplanscuscompselect.php?cpyID=" . $row["company_ID"] ."'>" . $row["company_name"] . "<a></td>"
                    . "<td>" . $row["plan_name"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["server_name"] . "</td>"
                    . "<td>" . $row["operating_system"] . "</td>"
                    . "<td>" . $row["data_site_ID"] . "</td>"
                    . "<td>" . $row["latest_backup"] . "</td>"
                    . "<td class='table_link_cell'><a href='onlineplanseditcpyplanform.php?cpyID=". $row["company_ID"] . "'>Edit Plan<a></td>"
                    . "<td class='table_link_cell'><a href='onlineplansdeleteplanformoutput.php?cplID=". $row["chosen_plan_ID"] . "'>Delete Plan<a></td>
                    </tr>";
       }
       echo "<table></div>";
} else {
    echo "No Results Found";
}
    
echo '<h2>Individual Clients</h2>';

// Calling stored procedure and assigning to result variable
$sql = "SELECT * FROM customer_plan_info_view;";
$result = $conn->query($sql);

// Validation for successful retrieval
if ($result->num_rows > 0) {
 echo "<div><table>
       <tr><th>Customer Name</th><th>Plan Name</th><th>Start Date</th><th>End Date</th><th>Server Name</th><th>Operating System</th><th>Data Site ID</th><th>Latest_Backup</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><a href='onlineplanscuscompselect.php?cusID=" . $row["customer_ID"] . "'>" . $row["first_name"] . " " . $row['last_name'] ."<a></td>"
                    . "<td>" . $row["plan_name"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["server_name"] . "</td>"
                    . "<td>" . $row["operating_system"] . "</td>"
                    . "<td>" . $row["data_site_ID"] . "</td>"
                    . "<td>" . $row["latest_backup"] . "</td>"
                    . "<td class='table_link_cell'><a href='onlineplanseditcusplanform.php?cusID=". $row["customer_ID"] . "'>Edit Plan<a></td>"
                    . "<td class='table_link_cell'><a href='onlineplansdeleteplanformoutput.php?cplID=". $row["chosen_plan_ID"] . "'>Delete Plan<a></td>
                    </tr>";
       }
       echo "<table></div>";
} else {
    echo "No Results Found";
}
   

//close db connection
$conn->close();
    
?>  
    

</body>
