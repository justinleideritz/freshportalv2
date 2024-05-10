<?php
global $conn;
require("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Data ophalen van form
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $birthdate = $_POST["birthdate"];
    $phone = $_POST["phone"];
    $description = $_POST["description"];

    //Query voor het kijken of er al een record is met dezelfde email
    $emailQuery = "SELECT COUNT(*) as count FROM employee WHERE EMP_Email = ?";
    $stmt = $conn->prepare($emailQuery);
    $stmt->execute([$email]);
    $emailCount = $stmt->fetch(PDO::FETCH_ASSOC);

    //Query voor het kijken of er al een record is met dezelfde telefoonnummer
    $phoneQuery = "SELECT COUNT(*) as count FROM employee WHERE EMP_Phone = ?";
    $stmt = $conn->prepare($phoneQuery);
    $stmt->execute([$phone]);
    $phoneCount = $stmt->fetch(PDO::FETCH_ASSOC);

    //Als de bovenste queries 1 of meer teruggeven worden er parameters toegevoegd in de URL zodat er een foutmelding wordt weergegeven
    //Anders wordt de "else" uitgevoerd waar de ingevulde data wordt opgeslagen
    $arr = [];
    if ($phoneCount['count'] > 0) {
        $arr[] = 'phone=exists';
    }
    if ($emailCount['count'] > 0) {
        $arr[] = 'email=exists';
    } else {
        $sqlQuery = "INSERT INTO employee (EMP_Firstname, EMP_Lastname, EMP_Email, EMP_Address, EMP_Birthdate, EMP_Phone, EMP_Description)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute([$firstName, $lastName, $email, $address, $birthdate, $phone, $description]);
        header("location: employeetable.php");
        exit;
    }
    header("location: create.php?" . implode('&', $arr));
}
