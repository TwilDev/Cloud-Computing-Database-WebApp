<body>
    
<?php
// Prerequisites 
include('header.html');
include('backupforms.php');
require('dbconn.php');
    
// Check for submit message from create/edit/delete forms
if (isset($_GET['submitmsg'])) {
    echo $_GET['submitmsg'];
} 

// Calling stored procedure and assigning to result variable
$sql = "CALL backup_information_sp()";
$result = $conn->query($sql);

// Validation for successful retrieval
if ($result->num_rows > 0) {
 echo "<div><table>
       <tr><th>Server Name</th><th>Backup Date</th><th>Status & Errors</th><th>Removal Date</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["server_name"] . "<a></td>"
                    . "<td>" . $row["backup_date"] . "</td>"
                    . "<td><a href='backuperr.php?bid=". $row["backup_ID"] . "'>" . $row["backup_status"] . "</td>"
                    . "<td>" . $row["removal_date"] . "</td>"
                    . "<td class='table_link_cell'><a href='backupdeleteformoutput.php?bID=". $row["backup_ID"] . "'>Delete<a></td>
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
