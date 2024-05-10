<?php
require("dbcon.php");

//Data van de form wordt opgeslagen in variabelen
$id = $_POST["id"];
$firstName = $_POST["firstname"];
$lastName = $_POST["lastname"];
$email = $_POST["email"];
$address = $_POST["address"];
$birthdate = $_POST["birthdate"];
$phone = $_POST["phone"];
$description = $_POST["description"];

//Hier wordt de bestaande data geupdate door de nieuwe ingevulde waardes van de form, als er iets is misgegaan wordt er een PDO error weergegeven
try {
    $sqlUpdate = "UPDATE employee SET EMP_Firstname=:firstname, EMP_Lastname=:lastname, EMP_Email=:email, EMP_Address=:address, EMP_Birthdate=:birthdate, EMP_Phone=:phone, EMP_Description=:description WHERE EMP_ID=:employeeid";
    $stmt = $conn->prepare($sqlUpdate);

    $stmt->bindparam(":employeeid", $id);
    $stmt->bindparam(":firstname", $firstName);
    $stmt->bindparam(":lastname", $lastName);
    $stmt->bindparam(":email", $email);
    $stmt->bindparam(":address", $address);
    $stmt->bindparam(":birthdate", $birthdate);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":description", $description);

    $updateExec = $stmt->execute();
    header("Location: employeetable.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}