<?php
// Include PHPMailer library
require 'vendor/autoload.php'; // Adjust the path if you are using Composer, e.g., require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer;

    // Set PHPMailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.brevo.com';  // Sendinblue SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = '3efb43001@smtp-brevo.com';  // Your Sendinblue email
    $mail->Password = 'CK79AfcdG4qEU3tD';  // Your Sendinblue SMTP password (not your account password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable encryption
    $mail->Port = 587;  // Use port 587 for TLS

    // Set email format to HTML
    $mail->isHTML(true);

    // Set the sender and recipient
    $mail->setFrom($email, $name);  // Sender's email and name
    $mail->addAddress('aminechouri1997@gmail.com');  // Recipient email (your Gmail or another email address)

    // Set email subject
    $mail->Subject = 'New Contact Form Submission from ' . $name;

    // Set email body
    $mail->Body = "<strong>Name:</strong> " . $name . "<br><strong>Email:</strong> " . $email . "<br><strong>Message:</strong><br>" . nl2br($message);

    // Send email
    if ($mail->send()) {
        // If the email is sent successfully
        echo "<p style='color:green;'>Thank you for contacting us! We will get back to you soon.</p>";
    } else {
        // If there is an error sending the email
        echo "<p style='color:red;'>Sorry, there was an error sending your message. Please try again later. Error: " . $mail->ErrorInfo . "</p>";
    }
}
?>
