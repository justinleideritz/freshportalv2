<?php
global $conn;
require_once 'dbcon.php';

$email = $_GET['email'];
$token = $_GET['token'];

$sql = "SELECT USE_ID FROM user WHERE USE_Email=:email AND USE_ResetToken = :token";
$stmt = $conn->prepare($sql);
$data = [
    'email' => $email,
    'token' => $token
];
$stmt->execute($data);
$result = $stmt->fetch(PDO::FETCH_OBJ);

if (!$result){

    echo 'No access';
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
<div class="top">
    <img src="./images/images-removebg-preview.png" alt="">
    <h1><span style="color: #a0bf39;">Reset</span> <span style="color: #4b556b">Password</span></h1>
</div>
<div class="wrapper">
    <form action="update-password.php" method="post">
        <div>
            <label>New password</label>
            <input type="password" name="new_password">
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password">
        </div>
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <div>
            <input type="submit" value="Reset Password">
        </div>
    </form>
</div>
</body>

</html>
<?php
}
?>