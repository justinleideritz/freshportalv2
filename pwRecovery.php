<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';
require "dbcon.php";

// Check of de email input is ingevuld
if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $token = generateRandomToken(); // random token genereren met de functie onderaan dit bestand

    $emailQuery = "SELECT USE_Username as username FROM user WHERE USE_Email = ?";
    $stmt = $conn->prepare($emailQuery);
    $stmt->execute([$email]);
    $username = $stmt->fetch(PDO::FETCH_ASSOC);

    // Send email with password reset link
    $resetLink = 'http://localhost/freshportalv2/ResetPasswordForm.php?email=' . urlencode($email) . '&token=' . urlencode($token);
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'milkshakenl98@gmail.com';
        $mail->Password = 'knhagkljfsdrayum';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';

        //Recipients
        $mail->setFrom('passwordrecover@noreply.com', 'Freshportal app');
        $mail->addAddress($email); // Add a recipient

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Recovery';
        $mail->Body = 'Your username: ' . $username['username'] . '<br>' . 'If you forgot your password, you can reset it here: <a href="' . $resetLink . '">Reset Password</a>';

        $mail->send();

        $sql = "UPDATE user SET USE_ResetToken = :resettoken WHERE USE_Email = :email";

        if ($stmt = $conn->prepare($sql)) {

            $stmt->bindParam(":resettoken", $token, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        } else {

            echo 'email not found';
        }

        if ($stmt->execute()) {

            //Doorgestuurd naar login en als de query niet uitgevoerd kan worden komt er een error
            header('Location: recoverPwForm.php?pwrecoveryemail=sent');
        } else {

            echo "Oops! Something went wrong with the query";
        }
        unset($stmt);


    } catch (Exception $e) {

        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {

    echo 'Email not submitted.';
}


// functie voor de token
function generateRandomToken($length = 32)
{
    return bin2hex(random_bytes($length));
}

?>
