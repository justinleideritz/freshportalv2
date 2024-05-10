<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/recover.css">
</head>

<body>
<?php
    if (isset($_GET['pwrecoveryemail'])) {
        $styleMessage = 'messageon';
    } else {
        $styleMessage = 'messageoff';
    }
?>
<div class="top">
    <img src="./images/images-removebg-preview.png" alt="">
    <h1><span style="color: #a0bf39;">Recover</span> <span style="color: #4b556b">Account</span></h1>
</div>
<div class="wrapper">
    <form action="pw-recover.php" method="post">
        <div>
            <label>Email</label>
            <input required type="text" name="email">
            <span class="<?= $styleMessage ?>">Email has been sent</span><br>
        </div>
        <div>
            <input type="submit" value="Recover">
        </div>
    </form>
</div>
</body>

</html>