<body>
    
<?php
// Prerequisites 
include ('header.html' );
require('dbconn.php');
    
//get passed form value
$hsID = $_POST['hsID'];

// Calling stored procedure and assigning to result variable
$sql = $conn->prepare("CALL specific_server_sp(?)");
$sql->bind_param("s",$hsID);
$sql->execute();
$result = $sql->get_result();

//Validation for successful retrieval
if ($result->num_rows > 0) {
 echo "<div><table>
       <tr><th>Server Name</th><th>Active Vms</th><th>Server Cores</th><th>Server RAM</th><th>Storage Capacity</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["server_name"] . "<a></td>"
                    . "<td>" . $row["virtual_server_num"] . "</td>"
                    . "<td>" . $row["server_cores"] . "</td>"
                    . "<td>" . $row["server_ram"] . "</td>"
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