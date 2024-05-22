<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freshportal | Create</title>
    <link rel="stylesheet" href="styles/create.css">
    <script src="https://kit.fontawesome.com/56f09bada5.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
session_start();
if (isset($_GET['email'])) {
    $styleEmail = "messageon";
} else {
    $styleEmail = "messageoff";
}

if (isset($_GET['phone'])) {
    $stylePhone = "messageon";
} else {
    $stylePhone = "messageoff";
}

?>

<?php
require 'components/form-navbar.php';
?>
<form action="createExec.php" method="POST">
    <div class="top">
        <h1><span style="color: #a0bf39;">Add</span> <span style="color: #4b556b">Employee</span></h1>
    </div>
    <div id="alertBoxEmail" class="<?= $styleEmail ?> alert">
        <p>Email already exists</p>
        <button onclick="hideEmailAlert()">Close</button>
    </div>
    <div id="alertBoxPhone" class="<?= $stylePhone ?> alert">
        <p>Phonenumber already exists</p>
        <button onclick="hidePhoneAlert()">Close</button>
    </div>
    <div>
        <label for="firstName">First name</label>
        <input required id="firstName" name="firstName" type="text">
    </div>
    <div>
        <label for="lastName">Last name</label>
        <input required id="lastName" name="lastName" type="text">
    </div>
    <div>
        <label for="email">Email</label>
        <input required id="email" name="email" type="text">
    </div>
    <div>
        <label for="phone">Phone</label>
        <input required id="phone" name="phone" minlength="10" type="text">
    </div>
    <div>
        <label for="address">Address</label>
        <input required id="address" name="address" type="text">
    </div>
    <div>
        <label for="birthdate">Birthdate</label>
        <input required id="birthdate" name="birthdate" type="date">
    </div>
    <div>
        <label for="description">Description</label>
        <input id="description" type="text" name="description">
    </div>
    <div>
        <input type="submit" value="Save">
        <a href="index.php">Back</a>
    </div>
</form>
<?php
require 'components/footer.php';
?>
<script>
    function hideEmailAlert() {
        document.getElementById("alertBoxEmail").style.display = "none";
    }

    function hidePhoneAlert() {
        document.getElementById("alertBoxPhone").style.display = "none";
    }
</script>
</body>

</html>