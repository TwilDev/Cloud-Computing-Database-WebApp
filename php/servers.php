<body>
    
<?php
// Prerequisites 
include ('header.html' );
include ('serverform.php');
require('dbconn.php');
    
// Check for submit message from create/edit/delete forms
if (isset($_GET['submitmsg'])) {
    echo $_GET['submitmsg'];
} 
    
// Calling stored procedure and assigning to result variable
$sql = "CALL server_and_backup_sp()";
$result = $conn->query($sql);

// Validation for successful retrieval
if ($result->num_rows > 0) {
 echo "<div><table>
       <tr><th>Server Name</th><th>Last Backup</th><th>Active Vms</th><th>Storage Capacity</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><a href='serverspecs.php?hsid=". $row["server_name"] . "'>" . $row["server_name"] . "<a></td>"
                    . "<td>" . $row["last_backup"] . "</td>"
                    . "<td>" . $row["virtual_server_num"] . "</td>"
                    . "<td>" . $row["server_storage"] . "</td>"
                    . "<td class='table_link_cell'><a href='serveraddeditform.php?svhID=". $row["server_name"] . "'>Edit<a></td>
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


