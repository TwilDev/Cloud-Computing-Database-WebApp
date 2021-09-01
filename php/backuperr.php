<body>
    
<?php
// Prerequisites 
include('header.html');
require('dbconn.php');

//assign post values to variables
$bID = $_GET['bid'];

//Prepared statement
$sql = $conn->prepare("CALL backup_err_info_sp(?)");
$sql->bind_param("s",$bID);
$sql->execute();
$result = $sql->get_result();
    
if ($result->num_rows > 0) {
     echo "<h4>Error Description</h4>";
    while ($row = $result->fetch_assoc()) {
        if ($row['error_description'] == null) {
             echo "<textarea readonly>No Errors to display.</textarea>";
        } else {
            echo "<textarea readonly>" . $row['error_description'] . "</textarea>";
        }
    }
} else {
    echo "No Records found";
}
    
?>