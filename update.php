<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freshportal | Update</title>
    <link rel="stylesheet" href="./styles/update.css">
    <script src="https://kit.fontawesome.com/56f09bada5.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
session_start();
require("dbcon.php");

//ID van de record in de URL wordt in een variabel gezet
$id = $_GET["id"];

//Query om data op te halen via het ID
$sqlUpdate = "SELECT * FROM employee WHERE EMP_ID=:employeeid";
$stmt = $conn->prepare($sqlUpdate);
$data = ['employeeid' => $id];
$stmt->execute($data);
$result = $stmt->fetch(PDO::FETCH_OBJ);
?>

<?php
require 'components/form-navbar.php';
?>

<form action="updateExec.php" method="POST">
    <div class="top">
        <h1><span style="color: #a0bf39;">Edit</span> <span style="color: #4b556b">Employee</span></h1>
    </div>
    <div>
        <label for="employeeid">ID</label>
        <input disabled required type="text" name="id" value="<?= $result->EMP_ID ?>">
    </div>
    <div>
        <label for="firstname">First name</label>
        <input required type="text" name="firstname" value="<?= $result->EMP_Firstname ?>">
    </div>
    <div>
        <label for="lastname">Last name</label>
        <input required type="text" name="lastname" value="<?= $result->EMP_Lastname ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input required type="text" name="email" value="<?= $result->EMP_Email ?>">
    </div>
    <div>
        <label for="phone">Phone</label>
        <input required type="text" minlength="10" name="phone" value="<?= $result->EMP_Phone ?>">
    </div>
    <div>
        <label for="address">Address</label>
        <input required type="text" name="address" value="<?= $result->EMP_Address ?>">
    </div>
    <div>
        <label for="birthdate">Birthdate</label>
        <input required type="date" name="birthdate" value="<?= $result->EMP_Birthdate ?>">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" value="<?= $result->EMP_Description ?>">
    </div>
    <input required type="submit" name="updateCustomer" value="Save">
    <a href="employeetable.php">Back</a>
</form>
<?php
require 'components/footer.php';
?>
</body>

</html>