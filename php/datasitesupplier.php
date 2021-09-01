<?php

//Pre-requisites
include('header.html');
require('dbconn.php');

$dsID = "{$_GET['dsID']}";
echo "<h1>Suppliers for " . $dsID . "</h1>";
// sql statment executed via paramatized prepared statment - avoiding sql injections
$sql = $conn->prepare("SELECT * FROM data_site_supplier_info_view WHERE data_site_ID LIKE ?;");
$sql->bind_param("s",$dsID);
$sql->execute();
$result = $sql->get_result();


if ($result->num_rows > 0) {
     echo "<div><table>
       <h4>Supplier Information</h4><tr><th>Supplier ID</th><th>Address Line 1</th><th>Address Line 2</th><th>Postal Code</th><th>City</th><th>County</th><th>Main Phone</th><th>Email Address</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
           
            $splID = $row['supplier_ID'];
           
         echo "<tr>
                    <td>" .  $row['supplier_ID'] . "</td>"
                    . "<td>" . $row["address_line_1"] . "</td>"
                    . "<td>" . $row["address_line_2"] . "</td>"
                    . "<td>" . $row["postcode"] . "</td>"
                    . "<td>" . $row["city"] . "</td>"
                    . "<td>" . $row["county"] . "</td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>"
                    . "<td class='table_link_cell'><a href='datasiteeditsupplierform.php?splID=". $row["supplier_ID"] . "'>Edit<a></td>
                    </tr>";
       }
       echo "<table></div>";
       include('datasitesupplieradd.php');
        echo " <form method='post' action='datasiteaddsplrcontactform.php'>
            <br><input type='hidden' value=".$dsID." name='dsID'>
            <input type='submit' value='Add New Contact'>
            </form>";
} else {
    echo "No Results Found";
} 

//prepare, bind and execute statement 
$sql = $conn->prepare("SELECT * FROM data_site_supplier_contact_info_view WHERE data_site_ID LIKE ?;");
$sql->bind_param("s",$dsID);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
     echo "<div><h4>Supplier Contact Information</h4>
       <table>
       <tr><th>Supplier Contact ID</th><th>First Name</th><th>Last Name</th><th>Job Title</th><th>Main Phone</th><th>Mobile Phone</th><th>Email Address</th><th>Supplier ID</th></tr>";
       // Loop through and print as table
       while ($row = $result->fetch_assoc()) {
           
           $splID = $row['contact_supplier_ID'];
           
         echo "<tr>
                    <td>" .  $row['supplier_contact_ID'] . "</td>"
                    . "<td>" . $row["first_name"] . "</td>"
                    . "<td>" . $row["last_name"] . "</td>"
                    . "<td>" . $row["job_title"] . "</td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["mobile_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>"
                    . "<td>" . $row["contact_supplier_ID"] . "</td>"
                    . "<td class='table_link_cell'><a href='datasiteeditsplcontactform.php?spcID=". $row["supplier_contact_ID"] . "'>Edit<a></td>"
                    . "<td class='table_link_cell'><a href='datasitedeletesplcontactformoutput.php?spcID=". $row["supplier_contact_ID"] . "'>Delete<a></td>
                    </tr>";
       }
       echo "<table></div>";
       //Echo out form to add new supplier contact

} else {
    echo "<br>No Contact Found";
} 


$conn->close();
?>