<!-- Form for adding new host server -->
<?php 
include('header.html');
require('dbconn.php');

//Initialize variables
$conID = '';
$conFirstName = '';
$conLastName = '';
$conAdrLineOne = '';
$conAdrLineTwo = '';
$conPostcode = '';
$conCity = '';
$conCounty = '';
$conMainPhone = '';
$conMobilePhone = '';
$conEmail = '';
$cpyID = '';

if (isset($_POST['operationType'])) {
    echo "<h4>Create New Contact</h4>";
    $cpyID = $_POST['cpyID'];
} else {
    echo "<h4>Edit Contact</h4>";
    
    $conID = $_GET['conID'];

    $sql = $conn->prepare("CALL edit_cpy_contact_sp(?);");
    $sql->bind_param("s",$conID);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        //Assign variables if data retrieved
        $conID = $row['company_contact_ID'];
        $conFirstName = $row['first_name'];
        $conLastName = $row['last_name'];
        $conAdrLineOne = $row['address_line_1'];
        $conAdrLineTwo = $row['address_line_2'];
        $conPostcode = $row['postcode'];
        $conCity = $row['city'];
        $conCounty = $row['county'];
        $conMainPhone = $row['main_phone'];
        $conMobilePhone = $row['mobile_phone'];
        $conEmail = $row['email'];
        $cpyID = $row['company_ID'];
        

        
        
    } else {
        echo "No Results Found";
    }
    
}

?>
<form method="post" action="onlineplansaddeditcompanycontactformoutput.php">
        
        <?php 
            if (isset($_POST['operationType'])) {
                echo "<input type='hidden' name='operationType' value='add'>";
                echo "<label>Contact ID: </label>";
                echo "<input type='text' name='conID' maxlength='8' placeholder='CONXXXXX'><br>";
            } else {
                echo " <input type='hidden' name='conID' value=".$conID.">";
            }
        ?>
        <input type="hidden" name="cpyID" value="<?php echo $cpyID; ?>">
        <label>Company Contact First Name: </label>
        <input type="text" name="conFirstName" value="<?php echo $conFirstName; ?>"><br>
        <label>Company Contact Last Name: </label>
        <input type="text" name="conLastName" value="<?php echo $conLastName; ?>"><br>
        <label>Address Line 1: </label>
        <input type="text" name="conAdrLineOne" value="<?php echo $conAdrLineOne; ?>"><br>
        <label>Address Line 2: </label>
        <input type="text" name="conAdrLineTwo" value="<?php echo $conAdrLineTwo; ?>"><br>
        <label>Postcode: </label>
        <input type="text" name="conPostcode" value="<?php echo $conPostcode; ?>"><br>
        <label>City: </label>
        <input type="text" name="conCity" value="<?php echo $conCity; ?>"><br>
        <label>County: </label>
        <input type="text" name="conCounty" value="<?php echo $conCounty; ?>"><br>
        <label>Main Phone: </label>
        <input type="text" name="conMainPhone" value="<?php echo $conMainPhone; ?>"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="conMobilePhone" value="<?php echo $conMobilePhone; ?>"><br>
        <label>Email: </label>
        <input type="text" name="conEmail" value="<?php echo $conEmail; ?>"><br>
    
        <br><input id="finalSubmit" type="submit" value="Confirm">
</form>