<?php
session_start();
require 'dbcon.php';

// Define variables and initialize with empty values
$username = $email = $firstname = $lastname = $password = $confirm_password = "";
$username_err = $email_err = $firstname_err = $lastname_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.<br><br>";
    } else {
        $sql = "SELECT USE_ID FROM user WHERE USE_Username = :username";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken.<br><br>";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.<br><br>";
    } else {
        $sql = "SELECT USE_ID FROM user WHERE USE_Email = :email";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "This email is already taken.<br><br>";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.<br><br>";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.<br><br>";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.<br><br>";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.<br><br>";
        }
    }

    // Validate firstname
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Please enter a firstname.<br><br>";
    } else {
        $firstname = trim(ucfirst($_POST["firstname"]));
    }

    // Validate lastname
    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Please enter a lastname.<br><br>";
    } else {
        $lastname = trim(ucfirst($_POST["lastname"]));
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($firstname_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO user (USE_Username, USE_Firstname, USE_Lastname, USE_Password, USE_Email) VALUES (:username, :firstname, :lastname, :password, :email)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    // Close connection
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
            <label>Firstname</label>
            <input type="text" name="firstname">
            <span><?php echo $firstname_err; ?></span>
        </div>
        <div>
            <label>Lastname</label>
            <input type="text" name="lastname">
            <span><?php echo $lastname_err; ?></span>
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
        <p>Already have an account? <a href="index.php">Login here</a></p>
    </form>
</div>
</body>

</html>
