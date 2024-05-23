<?php
global $conn;
require 'dbcon.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freshportal | Manage Acount</title>
    <link rel="stylesheet" href="./styles/manage.css">
    <script src="https://kit.fontawesome.com/56f09bada5.js" crossorigin="anonymous"></script>

</head>

<body>
<?php
session_start();
require 'components/form-navbar.php';
?>

<?php
$username = $_SESSION["username"];
$sqlUpdate = "SELECT * FROM user WHERE USE_ID=:id";
$stmt = $conn->prepare($sqlUpdate);
$data = ['id' => $_SESSION["id"]];
$stmt->execute($data);
$result = $stmt->fetch(PDO::FETCH_OBJ);
?>
<form action="manageExec.php" method="POST">
    <div class="top">
        <h1><span style="color: #a0bf39;">Account</span> <span style="color: #4b556b">Profile</span></h1>
    </div>
    <div>
        <label for="id">ID</label>
        <input disabled required id="id" name="id" type="text" value="<?= $result->USE_ID ?>">
    </div>
    <div>
        <label for="username">Username</label>
        <input required id="username" name="username" type="text" value="<?= $result->USE_Username ?>">
    </div>
    <div>
        <label for="firstname">Firstname</label>
        <input required id="firstname" name="firstname" type="text" value="<?= $result->USE_Firstname ?>">
    </div>
    <div>
        <label for="lastname">Lastname</label>
        <input required id="lastname" name="lastname" type="text" value="<?= $result->USE_Lastname ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input required id="email" name="email" type="text" value="<?= $result->USE_Email ?>">
    </div>
    <div>
        <input type="submit" value="Save">
        <a href="index.php">Back</a>
    </div>
    <p>Would you like to change password? <a href="recoverPwForm.php">Change it here</a></p>
</form>
<?php
require 'components/footer.php';
?>
</body>

</html>