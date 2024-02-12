<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Create email message
    $subject = "Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

    // Send email
    $toEmail = "lib@gmail.com"; // library email
    $headers = "From: $email";

    mail($toEmail, $subject, $body, $headers); 

    // Send WhatsApp message (you may need to use an external service for this)
    $whatsappNumber = "+9617151652264"; // library number
    $whatsappMessage = "New contact form submission from $name - Email: $email - Phone: $phone";

    // You may need to use an external service/API to send WhatsApp messages
    // This is just a placeholder
    // Replace the following line with the actual code to send a WhatsApp message
    mail($whatsappNumber . "@your-whatsapp-email-gateway.com", "", $whatsappMessage);

    // Redirect back to the form page
    header("Location: contactUs.php?status=success");
    exit;
} else {
    // Redirect back to the form page with an error status
    header("Location: contactUs.php?status=error");
    exit;
}
?>
