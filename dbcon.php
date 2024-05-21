<?php

//Variabelen met gegevens van de database
$servername = "localhost";
$username = "root";
$password = "";
$database = "freshportal";

//Connectie wordt hier gemaakt met de waardes van hierboven
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
?>