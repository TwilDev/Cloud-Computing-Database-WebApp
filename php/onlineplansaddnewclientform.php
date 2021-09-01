<!-- Form for adding new client -->
<?php 
include('header.html');
require('dbconn.php');

?>

<h4>Create New Client</h4>

<form method="post" action="onlineplansaddclientformoutput.php">
    
    <h5>Choose Client Type</h5>
    <input type="radio" id="cpyID" name="radioclID" value="cpyID" onCLick="toggleFormOptions()">
    <label for="cpyID">Company</label>
    <input type="radio" id="cusID" name="radioclID" value="cusID" onCLick="toggleFormOptions()">
    <label for="cusID">Customer</label><br>
    
    
    <div id="contactSection" style="display:none;">
        <h5>Include Company Contact?</h5>
        <input type="radio" id="bigtrue" name="radioconID" value="conTrue" onClick="toggleContactInputs()">
        <label for="cpyID">Yes</label>
        <input type="radio" id="conFalse" name="radioconID" value="conFalse" onClick="toggleContactInputs()">
        <label for="cusID">No</label><br>
    </div>
    
    <div id="companyInputFields" style="display:none;">
        <h5>Enter Company Information</h5>
        <label>Company ID: </label>
        <input type="text" name="cpyID" maxlength="8" placeholder="CO000000"><br>
        <label>Company Name: </label>
        <input type="text" name="companyName"><br>
        <label>Address Line 1: </label>
        <input type="text" name="cpyAdrLineOne"><br>
        <label>Address Line 2: </label>
        <input type="text" name="cpyAdrLineTwo"><br>
        <label>Postcode: </label>
        <input type="text" name="cpyPostcode"><br>
        <label>City: </label>
        <input type="text" name="cpyCity"><br>
        <label>County: </label>
        <input type="text" name="cpyCounty"><br>
        <label>Main Phone: </label>
        <input type="text" name="cpyMainPhone"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="cpyMobilePhone"><br>
        <label>Email: </label>
        <input type="text" name="cpyEmail"><br>
    </div>

    <div id="contactInputFields" style="display:none;">
        <h5>Enter Company Contact Information</h5>
        <label>Company Contact ID: </label>
        <input type="text" maxlength="8" name="conID" placeholder="CON00000"><br>
        <label>Company Contact First Name: </label>
        <input type="text" name="conFirstName"><br>
        <label>Company Contact Last Name: </label>
        <input type="text" name="conLastName"><br>
        <label>Address Line 1: </label>
        <input type="text" name="conAdrLineOne"><br>
        <label>Address Line 2: </label>
        <input type="text" name="conAdrLineTwo"><br>
        <label>Postcode: </label>
        <input type="text" name="conPostcode"><br>
        <label>City: </label>
        <input type="text" name="conCity"><br>
        <label>County: </label>
        <input type="text" name="conCounty"><br>
        <label>Main Phone: </label>
        <input type="text" name="conMainPhone"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="conMobilePhone"><br>
        <label>Email: </label>
        <input type="text" name="conEmail"><br>
    </div>
    
    <div id="customerInputFields" style="display:none;">
        <h5>Enter Customer Information</h5>
        <label>Customer ID: </label>
        <input type="text" name="cusID" maxlength="8" placeholder="CU000000"><br>
        <label>Customer First Name: </label>
        <input type="text" name="cusFirstName"><br>
        <label>Customer Last Name: </label>
        <input type="text" name="cusLastName"><br>
        <label>Address Line 1: </label>
        <input type="text" name="cusAdrLineOne"><br>
        <label>Address Line 2: </label>
        <input type="text" name="cusAdrLineTwo"><br>
        <label>Postcode: </label>
        <input type="text" name="cusPostcode"><br>
        <label>City: </label>
        <input type="text" name="cusCity"><br>
        <label>County: </label>
        <input type="text" name="cusCounty"><br>
        <label>Main Phone: </label>
        <input type="text" name="cusMainPhone"><br>
        <label>Mobile Phone: </label>
        <input type="text" name="cusMobilePhone"><br>
        <label>Email: </label>
        <input type="text" name="cusEmail"><br>
    </div>
    <br>
    <input id="finalSubmit" type="submit" value="Confirm" style="display:none">
</form>


<!-- Basic Script to reveal certain aspects of the form based upon the choices selected -->

<script type="text/javascript">
    
function toggleFormOptions() {
    if (document.getElementById('cpyID').checked) {
        document.getElementById('contactSection').style.display = '';
        document.getElementById('companyInputFields').style.display = '';
        document.getElementById('customerInputFields').style.display = 'none';
        document.getElementById('finalSubmit').style.display = '';
    } else {
        document.getElementById('customerInputFields').style.display = '';
        document.getElementById('contactSection').style.display = 'none';
        document.getElementById('contactInputFields').style.display = 'none';
        document.getElementById('companyInputFields').style.display = 'none';
        document.getElementById('finalSubmit').style.display = '';
    }
} 

function toggleContactInputs() {
    if (document.getElementById('bigtrue').checked) {
        document.getElementById('contactInputFields').style.display = '';
    } else {
        document.getElementById('contactInputFields').style.display = 'none';
    }
}

</script>
