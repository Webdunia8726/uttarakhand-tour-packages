<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer autoload

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $travelDate = $_POST['travel-date'];
    $travelerCount = $_POST['traveler-count'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';
        $mail->Password = 'your-email-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and Recipient
        $mail->setFrom('your-email@gmail.com', 'Your Name');
        $mail->addAddress('recipient-email@example.com', 'Admin');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Travel Inquiry';
        $mail->Body    = "
            <h3>New Travel Inquiry</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Travel Date:</strong> $travelDate</p>
            <p><strong>Traveler Count:</strong> $travelerCount</p>
        ";

        // Send Email
        $mail->send();

        // Redirect to Thank You Page
        header("Location: thank-you.php");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
