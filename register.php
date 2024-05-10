<?php
session_start();

require 'dbcon.php';

// lege variabelen die later ingevuld kunnen worden
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Als de username leeg is dan krijg je een error anders wordt the username opgeslagen in de variabel $username anders word er gekeken of het bestaat
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username. <br><br>";
    } else {
        $sql = "SELECT USE_ID FROM user WHERE USE_Username = :username";

        //De ingevulde username wordt in de query gezet
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            //Query wordt uitgevoerd en als er dezelfde username bestaat komt er een foutmelding
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken. <br><br>";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    //Als de username leeg is dan krijg je een error anders wordt the username opgeslagen in de variabel $username anders word er gekeken of het bestaat
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter a email. <br><br>";
    } else {
        $sql = "SELECT USE_ID FROM user WHERE USE_Email = :email";

        //De ingevulde username wordt in de query gezet
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);

            //Query wordt uitgevoerd en als er dezelfde username bestaat komt er een foutmelding
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "This email is already taken. <br><br>";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }

    // Als er geen wachtwoord is ingevuld of wachtwoord is niet langer dan 6 character dan komt er een error
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.<br><br>";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters. <br><br>";
    } else {
        $password = trim($_POST["password"]);
    }

    // Als er geen wachtwoord is ingevuld krijg je een error anders worden de 2 wachtwoorden vergeleken met elkaar
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password. <br><br>";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match. <br><br>";
        }
    }

    // Hier wordt gekeken of er geen foutmeldingen zijn
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Query wordt gemaakt om de nieuwe gebruiker toe te voegen
        $sql = "INSERT INTO user (USE_Username, USE_Password, USE_Email) VALUES (:username, :password, :email)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;

            //Query wordt uitgevoerd
            if ($stmt->execute()) {
                //Doorgestuurd naar login en als de query niet uitgevoerd kan worden komt er een error
                header("location: index.php");
            } else {
                echo "Oops! Something went wrong with the query";
            }
            unset($stmt);
        }
    }
    unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Freshportal | Register</title>
    <link rel="stylesheet" href="styles/register.css">
</head>

<body>
<div class="top">
    <img src="images/images-removebg-preview.png" alt="">
    <h1><span style="color: #a0bf39;">Make</span> <span style="color: #4b556b">Account</span></h1>
</div>
<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>
        </div>
        <div>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span><?php echo $email_err; ?></span>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
            <span><?php echo $confirm_password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
        <p>Already have an account? <a href="index.php">Login here</a>.</p>
    </form>
</div>
</body>

</html>