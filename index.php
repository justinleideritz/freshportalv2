<?php
session_start();

// Hier wordt gekeken of er al was ingelogd om dan gelijk doorgestuurd te worden naar de tabel
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: employeetable.php");
    exit;
}

require "dbcon.php";

$username = $password = "";
$username_err = $password_err = "";

//Check om te kijken of the method "POST" is
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Als de username leeg is dan krijg je een error anders wordt the username opgeslagen in de variabel $username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.<br><br>";
    } else {
        $username = trim($_POST["username"]);
    }

    //Als de password leeg is dan krijg je een error anders wordt the password opgeslagen in de variabel $password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.<br><br>";
    } else {
        $password = trim($_POST["password"]);
    }

    // Als de errors in de variabelen allebij leeg zijn wordt het ID, username en wachtwoord opgehaald
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT USE_ID, USE_Username, USE_Password FROM user WHERE USE_Username = :username";

        //Hier wordt gekeken of the query is ophaald of niet zo ja dan gaat die verder
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = $username;

            // De query wordt uitgevoerd met de meegegeven parameter als het bestaat
            if ($stmt->execute()) {

                // Hier wordt gekeken of de gebruiker bestaat
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["USE_ID"];
                        $username = $row["USE_Username"];
                        $hashed_password = $row["USE_Password"];

                        // Hier wordt gekeken of the wachtwoorden overeenkomen
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            // Data wordt opgeslagen in sessie variabelen
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Doorgestuurd naar de tabel
                            header("location: employeetable.php");
                        } else {
                            // Als het wachtwoord fout is wordt de foutmelding weergegeven
                            $password_err = "The password you entered was not valid.<br><br>";
                        }
                    }
                } else {
                    // Als de username niet bestaat wordt er een foutmelding weergeven
                    $username_err = "No account found with that username.<br><br>";
                }

                // Foutmelding als er iets mis is gegaan hierboven
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
<div class="top">
    <img src="images/images-removebg-preview.png" alt="">
    <h1><span style="color: #a0bf39;">Log</span> <span style="color: #4b556b">In</span></h1>
</div>
<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign up now</a></p>
        <p>Forgot password? <a href="recoverPwForm.php">Recover account</a></p>
    </form>
</div>
</body>

</html>