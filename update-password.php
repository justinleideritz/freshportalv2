<?php
include 'dbcon.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];
    $token = $_POST['token'];

    // Validate that passwords match
    if ($newPassword === $confirmPassword) {
        // Securely hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {

            // Update password in the database
            $sql = "UPDATE user SET USE_Password=:password WHERE USE_Email=:email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            $stmt->execute();


            echo 'Password updated successfully. You can login now! <a href="index.php">Login</a>';
        } catch(PDOException $e) {

            echo 'Error updating password: ' . $e->getMessage();
        }
    } else {

        echo 'Passwords do not match.';
    }
} else {

    // If form is not submitted, redirect to the reset password page
    header("Location: reset-password.php");
    exit;
}
?>
