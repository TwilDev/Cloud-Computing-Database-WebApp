<body>
    
<?php
// Prerequisites 
include('header.html');
require('dbconn.php');
    
//get passed form value
$searchID = $_POST['searchID'];
$searchType = $_POST['radioID'];
    

//Function for outputting customer search results    
function forwardToCustQuery($result) {
    echo "<div id='customer'><table>
       <tr><th>First Name</th><th>Last Name</th><th>Address Line 1</th><th>Address Line 2</th><th>Postcode</th><th>City</th><th>County</th><th>Main Phone</th><th>Mobile Phone</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                       <td>" . $row["first_name"] . "<a></td>"
                    . "<td>" . $row["last_name"] . "</td>"
                    . "<td>" . $row["address_line_1"] . "</td>"
                    . "<td>" . $row["address_line_2"] . "</td>"
                    . "<td>" . $row["postcode"] . "</td>"
                    . "<td>" . $row["city"] . "</td>"
                    . "<td>" . $row["county"] . "</td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["mobile_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>"
                    . "<td class='table_link_cell'><a href='onlineplanseditcusform.php?cusID=". $row["customer_ID"] . "'>Edit<a></td>"
                    . "<td class='table_link_cell'><a href='onlineplansdeletecusformoutput.php?cusID=". $row["customer_ID"] . "'>Delete<a></td>
                    </tr>";
       }
       echo "<table></div>";
}

//Upon finding company information, ID is passed to this function to check if the company has a primary contact 
function checkContactExists($cID) {

    require('dbconn.php');
    //Prepared statement
    $sql = $conn->prepare("SELECT * FROM company_contact_info_view WHERE company_ID LIKE ?");
    $sql->bind_param("s",$cID);
    $sql->execute();
    $result = $sql->get_result();
    
    if ($result->num_rows > 0) {
        echo "<div id='customer_contact'>";
        echo "<table>
       <h4>Company Contact Information</h4><tr><th>First Name</th><th>Last Name</th><th>Address Line 1</th><th>Address Line 2</th><th>Postcode</th><th>City</th><th>County</th><th>Main Phone</th><th>Mobile Phone</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                           <td>" . $row["first_name"] . "<a></td>"
                        . "<td>" . $row["last_name"] . "</td>"
                        . "<td>" . $row["address_line_1"] . "</td>"
                        . "<td>" . $row["address_line_2"] . "</td>"
                        . "<td>" . $row["postcode"] . "</td>"
                        . "<td>" . $row["city"] . "</td>"
                        . "<td>" . $row["county"] . "</td>"
                        . "<td>" . $row["main_phone"] . "</td>"
                        . "<td>" . $row["mobile_phone"] . "</td>"
                        . "<td>" . $row["email"] . "</td>"
                        . "<td class='table_link_cell'><a href='onlineplansaddeditcompanycontactform.php?conID=". $row["company_contact_ID"] . "'>Edit<a></td>"
                        . "<td class='table_link_cell'><a href='onlineplansdeletecompanycontactformoutput.php?conID=". $row["company_contact_ID"] . "'>Delete<a></td>
                        </tr>";
           }
           echo "</table></div>";
           
    } else {
        echo("<h4>No Contact listed</h4>");
    }
    $conn->close();
}
    
    
//Checks for radio button value to search for specific type of customer
if ($searchType == "cusID") {
    
    //split all inputs at space 
    $cusname = explode(" ",$searchID);
    
    //prepare query
    $sql = $conn->prepare("SELECT * FROM customer_info_view WHERE first_name LIKE ? OR last_name LIKE ?");
    
    //check each word of input as both the first and last name
    foreach ($cusname as $value) {
        $sql->bind_param("ss",$value,$value);
        $sql->execute();
        $result = $sql->get_result();
        //if check returns rows call function with result as parameter
        if ($result->num_rows > 0) {
            forwardToCustQuery($result);
            break;
        } else {
            echo "<h4>No Customers found matching search terms</h4>";
        } 
    }
//Check to see if Company radio button is selected
} else if ($searchType == "cpyID") {
    //Assign input value to another variable
    $cpyID = $searchID;
    
    //Create prepared statement and bind values to avoid potential SQL injection
    $sql = $conn->prepare("SELECT * FROM company_info_view WHERE company_name LIKE ?");
    $sql->bind_param("s",$cpyID);
    $sql->execute();
    $result = $sql->get_result();
    
    //Check SQL statement successful
    if ($result->num_rows > 0) {
        echo "<div id='company_table'><table>
       <tr><th>Company ID</th><th>Company Name</th><th>Address Line 1</th><th>Address Line 2</th><th>Postcode</th><th>City</th><th>County</th><th>Main Phone</th><th>Mobile Phone</th><th>Email</th></tr>";
    //Print out rows as associative array
    while ($row = $result->fetch_assoc()) {
        echo("<h4>Details for Company</h4>");
        echo "<tr>
                       <td>" . $row["company_ID"] . "<a></td>"
                    . "<td>" . $row["company_name"] . "</td>"
                    . "<td>" . $row["address_line_1"] . "</td>"
                    . "<td>" . $row["address_line_2"] . "</td>"
                    . "<td>" . $row["postcode"] . "</td>"
                    . "<td>" . $row["city"] . "</td>"
                    . "<td>" . $row["county"] . "</td>"
                    . "<td>" . $row["main_phone"] . "</td>"
                    . "<td>" . $row["mobile_phone"] . "</td>"
                    . "<td>" . $row["email"] . "</td>"
                    . "<td class='table_link_cell'><a href='onlineplanseditcpyform.php?cpyID=". $row["company_ID"] . "'>Edit<a></td>"
                    . "<td class='table_link_cell'><a href='onlineplansdeletecompanyformoutput.php?cpyID=". $row["company_ID"] . "'>Delete<a></td>
                    </tr>";
        //Take company ID and call function to check for any contacts
        $cID = $row['company_ID'];
        checkContactExists($cID);
        
       }
       echo "</table></div>";
       echo '
        <h4>Add New Contact for Company</h4>
        <form method="post" action="onlineplansaddeditcompanycontactform.php">
        <input type="hidden" value='.$cpyID.' name="cpyID">
        <input type="hidden" value="add" name="operationType">
        <input type="submit" value="Add New Contact">
        </form>';
        
    } else {
        echo "<h4>No Records found matching search terms</h4>";
    }
} else {
    echo "Invalid search input";
}

//close db connection
$conn->close();
    
?>  
</body>