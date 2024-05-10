<?php

//Variabelen met gegevens van de database
$servername = "localhost";
$username = "root";
$password = "";
$database = "freshportal";

//Connectie wordt hier gemaakt met de waardes van hierboven
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

//Deze query selecteerd alles van de tabel employee en alle records worden in een array gezet
$sqlSelectAll = "SELECT * FROM employee";
$sqlTable = $conn->query($sqlSelectAll);
?>