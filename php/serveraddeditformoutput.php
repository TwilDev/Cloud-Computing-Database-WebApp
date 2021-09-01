<?php

function editServerDetails() {
    
    require('dbconn.php');

    //Assign input values to variables
    $serverName = $_POST['serverName'];
//    $virtualServerNum = $_POST['virtualServerNum'];
    $serverCores = $_POST['serverCores'];
    $serverRam = $_POST['serverRam'];
    $serverStorage = $_POST['serverStorage'];
    $dsID = $_POST['dsID'];

    //Prepare statment
    $sql = $conn->prepare("UPDATE host_server SET server_name=?, server_cores=?, server_ram=?, server_storage=?, data_site_ID=? WHERE server_name LIKE ?;");
    $sql->bind_param("ssssss",$serverName,$serverCores,$serverRam,$serverStorage,$dsID,$serverName);

    if ($sql->execute()) {
        $success = "Update Successful";
        header("Location: servers.php?submitmsg='$success'");
    } else {
        $error = "Erorr during update process";
        header("Location: servers.php?submitmsg='$error'");
    }

    $conn->close();
    
}

function addNewServer() {
    
    require('dbconn.php');

    //Assign input values to variables
    $serverName = $_POST['serverName'];
    $serverCores = $_POST['serverCores'];
    $serverRam = $_POST['serverRam'];
    $serverStorage = $_POST['serverStorage'];
    $dsID = $_POST['dsID'];
    
    echo $serverName, " ", $serverCores, " ", $serverRam, " ", $serverStorage, " ", $dsID;

    //Prepare statment
    $sql = $conn->prepare("INSERT INTO host_server 
                        (server_name, server_cores, server_ram, server_storage, data_site_ID) 
                        VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss",$serverName,$serverCores,$serverRam,$serverStorage,$dsID);




    if ($sql->execute()) {
        $success = "New Rows created successfully";
        header("Location: servers.php?submitmsg='$success'");
    } else {
        $error = "Erorr during creation process please check inputs";
        header("Location: servers.php?submitmsg='$error'");
    }

    $conn->close();

    
}

//Check input type
if (isset($_POST['operationType'])) {
    addNewServer();
} else {
    editServerDetails();
}

?>