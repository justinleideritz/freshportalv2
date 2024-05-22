<?php
include 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];
    $token = $_POST['token'];

    // Check voor de 2 wachtwoorden of ze overeenkomen
    if ($newPassword === $confirmPassword) {
        // Het nieuwe wachtwoord word gehasht
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {

            // wachtwoord wordt geupdate in de database
            $sql = "UPDATE user SET USE_Password=:password WHERE USE_Email=:email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            //token wordt verwijdert nadat ie niet meer nodig is
            $sql2 = "UPDATE user SET USE_ResetToken=null WHERE USE_Email=:email";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(':email', $email);
            $stmt2->execute();

            header('Location: index.php');
        } catch (PDOException $e) {

            echo 'Error updating password: ' . $e->getMessage();
        }
    } else {

        echo 'Passwords do not match.';
    }
} else {

    header("Location: ResetPasswordForm.php");
    exit;
}
?>
