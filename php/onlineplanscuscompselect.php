<?php

// Prerequisites 
include('header.html');

function getCpyYearPayments($yearDiff, $cpyID) {
        
    require('dbconn.php');

    if ($yearDiff > 0) {
            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_annual, start_date, end_date, yearDIFF*plan_price_annual as total_ammount_paid FROM cpy_payment_view WHERE company_ID LIKE ?");
            $sql->bind_param("s",$cpyID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_annual"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve data";
            }
        } else {
            //Echo out results with 1 payment
            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_annual, start_date, end_date, plan_price_annual as total_ammount_paid FROM cpy_payment_view WHERE company_ID LIKE ?");
            $sql->bind_param("s",$cpyID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_annual"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve payment information";
            }
        }
}

function getCpyMonthPayments($monthDiff, $cpyID) {
        
    require('dbconn.php');

    if ($monthDiff > 0) {
            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_monthly, start_date, end_date, monthDIFF*plan_price_monthly as total_ammount_paid FROM cpy_payment_view WHERE company_ID LIKE ?");
            $sql->bind_param("s",$cpyID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_monthly"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve data";
            }
        } else {
            //Echo out results with 1 payment

            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_monthly, start_date, end_date, plan_price_monthly as total_ammount_paid FROM cpy_payment_view WHERE company_ID LIKE ?");
            $sql->bind_param("s",$cpyID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_monthly"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve payment information";
            }
        }
        
}


function viewCompanyInformation() {
    
    require('dbconn.php');
    
    $cpyID = $_GET['cpyID'];
    echo '
    <h4>Add New Contact for Company</h4>
    <form method="post" action="onlineplansaddeditcompanycontactform.php">
    <input type="hidden" value='.$cpyID.' name="cpyID">
    <input type="hidden" value="add" name="operationType">
    <input type="submit" value="Add New Contact">
    </form>';
    
    //Create prepared statement and bind values to avoid potential SQL injection
    $sql = $conn->prepare("SELECT * FROM company_info_view WHERE company_ID LIKE ?");
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
           }
           echo "</table></div>";

    } else {
        echo "<h4>Invalid Company Name</h4>";
    }

    //Create prepared statement and bind values to avoid potential SQL injection
    $sql = $conn->prepare("SELECT * FROM company_contact_info_view WHERE company_ID LIKE ?");
    $sql->bind_param("s",$cpyID);
    $sql->execute();
    $result = $sql->get_result();

    //Echo out associated values after success or echo out error message
    if ($result->num_rows > 0) {
                echo "<div><table>
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
                        . "<td class='table_link_cell'><a href='onlineplansaddeditcompanycontactform.php?conID=". $row["company_contact_ID"] . "'>Edit<a></td>"
                        . "<td class='table_link_cell'><a href='onlineplansdeletecompanycontactformoutput.php?conID=". $row["company_contact_ID"] . "'>Delete<a></td>
                        </tr>";
           }
           echo "<table></div>";
        } else {
        echo "No Contacts found";
    }
    
    
    //Get payment information
    
    
    $sql = $conn->prepare("SELECT * FROM cpy_payment_view WHERE company_ID LIKE ?");
    $sql->bind_param("s",$cpyID);
    $sql->execute();
    $result = $sql->get_result();
    
    if ($result->num_rows > 0) {
        
        $paymentCheck = $result->fetch_assoc();
        $paymentType = $paymentCheck['plan_payment_method'];
        
        //Check Payment Tpe
        if ($paymentType == "Monthly") {
            //Check Month Diff
            $monthDiff = $paymentCheck['monthDIFF'];
            getCpyMonthPayments($monthDiff, $cpyID);
             
        } else if ($paymentType == "Annual") {
            $yearDiff = $paymentCheck['yearDIFF'];
            getCpyYearPayments($yearDiff, $cpyID);
            
        } else {
            echo "Failed to retrieve payment information";
        }
        
    } 
    
    
}

function getCusMonthPayments($monthDiff, $cusID) {
        
    require('dbconn.php');

    if ($monthDiff > 0) {
            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_monthly, start_date, end_date, monthDIFF*plan_price_monthly as total_ammount_paid FROM cus_payment_view WHERE customer_ID LIKE ?");
            $sql->bind_param("s",$cusID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_monthly"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve data";
            }
        } else {
            //Echo out results with 1 payment

            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_monthly, start_date, end_date, plan_price_monthly as total_ammount_paid FROM cus_payment_view WHERE customer_ID LIKE ?");
            $sql->bind_param("s",$cusID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_monthly"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve payment information";
            }
        }
        
}
    
function getCusYearPayments($yearDiff, $cusID) {
        
    require('dbconn.php');


    if ($yearDiff > 0) {
            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_annual, start_date, end_date, yearDIFF*plan_price_annual as total_ammount_paid FROM cus_payment_view WHERE customer_ID LIKE ?");
            $sql->bind_param("s",$cusID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_annual"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve data";
            }
        } else {
            //Echo out results with 1 payment

            $sql = $conn->prepare("SELECT plan_payment_method, plan_price_annual, start_date, end_date, plan_price_annual as total_ammount_paid FROM cus_payment_view WHERE customer_ID LIKE ?");
            $sql->bind_param("s",$cusID);
            $sql->execute();
            $priceResult = $sql->get_result();

            if ($priceResult->num_rows > 0) {
                echo "<div id='payment_table'><table>
                      <tr><th>Plan Payment Method</th><th>Price</th><th>Start Date</th><th>End Date</th><th>Total Paid</th></tr>";
                while ($row = $priceResult->fetch_assoc()) {
                    echo("<h4>Payment Details</h4>");
                    echo "<tr>
                       <td>" . $row["plan_payment_method"] . "<a></td>"
                    . "<td>" . $row["plan_price_annual"] . "</td>"
                    . "<td>" . $row["start_date"] . "</td>"
                    . "<td>" . $row["end_date"] . "</td>"
                    . "<td>" . $row["total_ammount_paid"] . "</td>
                    </tr>";

                }
            } else {
                echo "failed to retrieve payment information";
            }
        }
}
    


function viewCustomerInformation() {
    
    require('dbconn.php');
    
    $cusID = $_GET['cusID'];
    
    //Create prepared statement and bind values to avoid potential SQL injection
    $sql = $conn->prepare("SELECT * FROM customer_info_view WHERE customer_ID LIKE ?");
    $sql->bind_param("s",$cusID);
    $sql->execute();
    $result = $sql->get_result();

    //Check SQL statement successful
    if ($result->num_rows > 0) {
        echo "<div id='company_table'><table>
       <tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Address Line 1</th><th>Address Line 2</th><th>Postcode</th><th>City</th><th>County</th><th>Main Phone</th><th>Mobile Phone</th><th>Email</th></tr>";
        
        //Print out rows as associative array
        while ($row = $result->fetch_assoc()) {
            echo("<h4>Details for Customer</h4>");
            echo "<tr>
                           <td>" . $row["customer_ID"] . "<a></td>"
                        . "<td>" . $row["first_name"] . "</td>"
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
           echo "</table></div>";

    } else {
        echo "<h4>Invalid Customer ID</h4>";
    }
    
    //Get payment information
    
    $sql = $conn->prepare("SELECT * FROM cus_payment_view WHERE customer_ID LIKE ?");
    $sql->bind_param("s",$cusID);
    $sql->execute();
    $result = $sql->get_result();
    
    if ($result->num_rows > 0) {
        
        $paymentCheck = $result->fetch_assoc();
        $paymentType = $paymentCheck['plan_payment_method'];
        
        //Check Payment Tpe
        if ($paymentType == "Monthly") {
            
            //Check Month Diff
            $monthDiff = $paymentCheck['monthDIFF'];
            getCusMonthPayments($monthDiff, $cusID);
             
        } else if ($paymentType == "Annual") {
            
            $yearDiff = $paymentCheck['yearDIFF'];
            getCusYearPayments($yearDiff, $cusID);
            
        } else {
            echo "Failed to retrieve payment information";
        }
        
    }  
    

}

if (isset($_GET['cpyID'])) {
    
    viewCompanyInformation();
    
} else if (isset($_GET['cusID'])) {
    
    viewCustomerInformation();
    
} else {
    echo "Invalid Customer Type";
}



?>