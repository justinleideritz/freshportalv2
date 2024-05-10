<?php
require("dbcon.php");

//ID van de geselecteerde werknemer wordt opgeslagen om op basis hiervan een record te verwijderen
$id = $_GET['id'];

//De query op een record te verwijderen op basis van het ID
$sql = "DELETE FROM employee WHERE EMP_ID = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: employeetable.php");
?>
