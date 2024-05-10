<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freshportal</title>
    <link rel="stylesheet" href="./styles/employeetable.css">
</head>

<body>
<?php
session_start();

// Hier wordt gekeken of er al was ingelogd anders wordt je gestuurd naar het login scherm
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

//Het uur van de tijd wordt in een variabel gegooit om dan in een if else gebruikte te kunnen worden
$current_hour = date('H');
//Verschillende berichten worden weergegeven op basis van tijd
if ($current_hour > 5 && $current_hour < 12) {
    $greeting = "Good morning";
} elseif ($current_hour >= 12 && $current_hour < 18) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}
?>
<nav>
    <div>
        <h1><span style="color: #a0bf39;">Employee</span> <span style="color: #4b556b">overview</span></h1>
    </div>
    <div>
        <?php
        echo "<h1><span style='color: #a0bf39;'>" . $greeting . ",</span> <span style='color: #4b556b;'>" . ucfirst($_SESSION['username']) . "</span></h1>";
        ?>
    </div>
</nav>
<?php
require("dbcon.php");

//Tabel wordt gemaakt
echo '<div class="table">';
echo "<a id='create' href='create.php'>Add Employee</a>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>ID</th> <th>First name</th> <th>Last name</th> <th>Email</th> <th>Phone</th>  <th>Address</th> <th>Birthdate<br>(Y/M/D)</th> <th>Description</th> <th>Edit</th> <th>Delete</th> <th>Created at<br>(Y/M/D)</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
//Elk object in de array krijgt de key "row" om dan met de identifier de data te kunnen laten weergeven
foreach ($sqlTable as $row) {
    echo "<tr>";
    echo "<td>" . $row["EMP_ID"] . "</td>";
    echo "<td>" . $row["EMP_Firstname"] . "</td>";
    echo "<td>" . $row["EMP_Lastname"] . "</td>";
    echo "<td>" . $row["EMP_Email"] . "</td>";
    echo "<td>" . $row["EMP_Phone"] . "</td>";
    echo "<td>" . $row["EMP_Address"] . "</td>";
    echo "<td>" . $row["EMP_Birthdate"] . "</td>";
    echo "<td>" . $row["EMP_Description"] . "</td>";
    //2 Anchor elementen voor het updaten en deleten van records
    echo "<td><a href='update.php?id=" . $row["EMP_ID"] . "'><i id='edit' class='fa-solid fa-pen-to-square'></i></a></td>";
    echo "<td><a href='delete.php?id=" . $row["EMP_ID"] . "'onclick='return confirmDelete()'><i id='delete' class='fa-solid fa-trash'></i></a></td>";
    echo "<td>" . $row["EMP_DateAdded"] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>
<a id="logout" href='logout.php'>Logout</a>
<div class="footer">
    <p class="footer-text">
        &copy; Justin Leideritz
    </p>
</div>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this row?");
    }
</script>
<script src="https://kit.fontawesome.com/56f09bada5.js" crossorigin="anonymous"></script>
</body>

</html>