<?php
require 'dbcon.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    //Hier wordt de bestaande data geupdate door de nieuwe ingevulde waardes van de form, als er iets is misgegaan wordt er een PDO error weergegeven
    try {
        $sqlUpdate = "UPDATE user SET USE_Username=:username, USE_Firstname=:firstname, USE_Lastname=:lastname, USE_Email=:email WHERE USE_ID=:id";
        $stmt = $conn->prepare($sqlUpdate);

        $stmt->bindparam(":username", $username);
        $stmt->bindparam(":firstname", ucfirst($firstname));
        $stmt->bindparam(":lastname", ucfirst($lastname));
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":id", $_SESSION["id"]);

        $updateExec = $stmt->execute();
        header("Location: employeetable.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "something went wrong";
}
