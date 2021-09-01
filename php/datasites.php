<body>
    
<?php
// Prerequisites 
include ('header.html');
include('datasiteforms.php');
require('dbconn.php');

// Check for submit message from create/edit/delete forms
if (isset($_GET['submitmsg'])) {
    echo $_GET['submitmsg'];
} 
   
    
// Calling stored procedure and assigning to result variable
$sql = "SELECT * FROM data_site_info_view;";
$result = $conn->query($sql);

// Validation for successful retrieval
if ($result->num_rows > 0) {
 echo "<div><table>
       <tr><th>Data Site ID</th><th>Site Phone Number</th><th>Site Email</th><th>Site Manager</th><th>Manager Phone</th><th>Staff Mobile</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
           
         echo "<tr>
                    <td><a href='datasitefullinfo.php?dsID=". $row["data_site_ID"] . "'>" . $row["data_site_ID"] . "<a></td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>"
                    . "<td>" . $row["site_manager"] . "</td>"
                    . "<td>" . $row["staff_phone"] . "</td>"
                    . "<td>" . $row["mobile_phone"] . "</td>"
                    . "<td class='table_link_cell'><a href='datasitesupplier.php?dsID=". $row["data_site_ID"] . "'>View Supplier<a></td>
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