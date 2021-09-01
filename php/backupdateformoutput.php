<body>
    
<?php
// Prerequisites 
include('header.html');
include('backupforms.php');
require('dbconn.php');

//assign post values to variables
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

//Prepared statement
$sql = $conn->prepare("CALL backup_by_date_sp(?,?)");
$sql->bind_param("ss",$startDate,$endDate);
$sql->execute();
$result = $sql->get_result();
    
if ($result->num_rows > 0) {
     echo "<div><table>
           <tr><th>Server Name</th><th>Backup Date</th><th>Status & Errors</th><th>Removal Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                    <td>" . $row["server_name"] . "<a></td>"
                    . "<td>" . $row["backup_date"] . "</td>"
                    . "<td><a href='backuperr.php?bid=". $row["backup_ID"] . "'>" . $row["backup_status"] . "</td>"
                    . "<td>" . $row["removal_date"] . "</td>
                    </tr>";
    }
} else {
    echo "No Records Found between inputted dates";
}
    
?>