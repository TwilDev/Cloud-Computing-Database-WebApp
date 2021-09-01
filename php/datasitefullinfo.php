<body>
    
<?php
// Prerequisites 
include ('header.html' );
require('dbconn.php');
    
//get passed form value
$dsID = $_GET['dsID'];

    
echo "<h2>Data Site Details</h2>";

// Prepared statement with View
$sql = $conn->prepare("SELECT * FROM data_site_full_info_view WHERE data_site_ID LIKE ?;");
$sql->bind_param("s",$dsID);
$sql->execute();
$result = $sql->get_result();

// Validation for successful retrieval
if ($result->num_rows > 0) {
    echo "<div><table>
       <tr><th>Data Site ID</th><th>Address Line 1</th><th>Address Line 2</th><th>Postcode</th><th>City</th><th>County</th><th>Main Phone</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                       <td>" . $row["data_site_ID"] . "<a></td>"
                    . "<td>" . $row["address_line_1"] . "</td>"
                    . "<td>" . $row["address_line_2"] . "</td>"
                    . "<td>" . $row["postcode"] . "</td>"
                    . "<td>" . $row["city"] . "</td>"
                    . "<td>" . $row["county"] . "</td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>"
                    . "<td class='table_link_cell'><a href='datasiteeditform.php?dsID=". $row["data_site_ID"] . "'>Edit<a></td>
                    </tr>";
       }
       echo "<table></div>";
} else {
    echo "No Results Found";
}  
    
echo "<h2>Data Site Staff Details</h2>";
echo "<form method='post' action='datasiteaddnewstaffform.php'>
    <input type='hidden' value='$dsID' name='dsID'>
    <input type='submit' value='Add New Staff Member'>
    </form>";


//Prepared statement for associated staff retrieval
$sql = $conn->prepare("SELECT * FROM staff_full_info_view WHERE data_site_ID LIKE ?;");
$sql->bind_param("s",$dsID);
$sql->execute();
$result = $sql->get_result();
    
// Validation for successful retrieval
if ($result->num_rows > 0) {
    echo "<div><table>
       <tr><th>Name</th><th>Job Title</th><th>Main Phone</th><th>Mobile Phone</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                       <td>" . $row["name"] . "<a></td>"
                    . "<td>" . $row["job_title"] . "</td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["mobile_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>"
                    . "<td class='table_link_cell'><a href='datasiteeditstaffform.php?stfID=". $row["staff_ID"] . "'>Edit<a></td>"
                    . "<td class='table_link_cell'><a href='datasitedeletestaffformoutput.php?stfID=". $row["staff_ID"] . "'>Delete<a></td>
                    </tr>";
       }
       echo "<table></div>";
} else {
    echo "No Results Found";
}

//Prepared statement using subquery to get customers at datasite
    
$sql = $conn->prepare("SELECT cus.customer_ID, cus.first_name, cus.last_name, cus.main_phone, cus.mobile_phone, cus.email 
                       FROM customer cus
                       WHERE cus.customer_ID IN (
                           SELECT cpl.customer_ID
                           FROM chosen_plan cpl
                           WHERE cpl.server_name IN (
                               SELECT svr.server_name
                               FROM host_server svr
                               WHERE svr.data_site_ID LIKE ?));");
$sql->bind_param("s",$dsID);
$sql->execute();
$result = $sql->get_result();
    
if ($result->num_rows > 0) {
    echo "<h3>Customer Clients hosted at Datasite</h3>";
    echo "<div><table>
       <tr><th>Customer ID</th><th>Name</th><th>Main Phone</th><th>Mobile Phone</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                       <td>" . $row["customer_ID"] ."</td>"
                    . "<td><a href='onlineplanscuscompselect.php?cusID=" . $row["customer_ID"] . "'>" . $row["first_name"] . " " . $row['last_name'] ."<a></td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["mobile_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>
                    </tr>";
       }
       echo "<table></div>";
} else {
    echo "No Customers Found at datasite";
}
    
//Prepared statement using subquery to get companies at datasite

$sql = $conn->prepare("SELECT cpy.company_ID, cpy.company_name, cpy.main_phone, cpy.mobile_phone, cpy.email 
                       FROM company cpy
                       WHERE cpy.company_ID IN (
                           SELECT cpl.company_ID
                           FROM chosen_plan cpl
                           WHERE cpl.server_name IN (
                               SELECT svr.server_name
                               FROM host_server svr
                               WHERE svr.data_site_ID LIKE ?));");
$sql->bind_param("s",$dsID);
$sql->execute();
$result = $sql->get_result();
    
if ($result->num_rows > 0) {
    echo "<h3>Company Clients hosted at Datasite</h3>";
    echo "<div><table>
       <tr><th>Company ID</th><th>Name</th><th>Main Phone</th><th>Mobile Phone</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                       <td>" . $row["company_ID"] ."</td>"
                    . "<td><a href='onlineplanscuscompselect.php?cpyID=" . $row["company_ID"] ."'>" . $row["company_name"] . "<a></td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["mobile_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>
                    </tr>";
       }
       echo "<table></div>";
} else {
    echo "No Customers Found at datasite";
}
    
    
//close db connection
$conn->close();
    
?>  
    
</body>