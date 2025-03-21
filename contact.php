<?php

$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$comments = $_POST['comments'];
$file = $_FILES['file'];

if (trim($name) == '') {
    echo '<div class="error_message">Attention! You must enter your name.</div>';
    exit();
} else if (trim($company) == '') {
    echo '<div class="error_message">Attention! Please enter your company name.</div>';
    exit();
} else if (trim($email) == '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<div class="error_message">Attention! Please enter a valid email address.</div>';
    exit();
} else if (trim($phone) == '') {
    echo '<div class="error_message">Attention! Please enter your phone number.</div>';
    exit();
} else if (empty($file['name'])) {
    echo '<div class="error_message">Attention! Please upload a file.</div>';
    exit();
} else if (trim($comments) == '') {
    echo '<div class="error_message">Attention! Please enter your message.</div>';
    exit();
}

// File upload processing
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true); // Create directory if it doesn't exist
}

$target_file = $upload_dir . basename($file['name']);
if (!move_uploaded_file($file['tmp_name'], $target_file)) {
    echo '<div class="error_message">Error! Unable to upload the file.</div>';
    exit();
}

// Prepare email with attachment
$to = "gartist529@gmail.com";
$subject = "You've been contacted by $name.";

// Email body
$body = "Name: $name\n";
$body .= "Company: $company\n";
$body .= "Email: $email\n";
$body .= "Phone: $phone\n";
$body .= "Comments:\n$comments\n";

// Read file content
$file_content = file_get_contents($target_file);
$file_encoded = chunk_split(base64_encode($file_content));
$file_name = basename($file['name']);

// Email headers for attachment
$boundary = md5("sanitized_boundary"); // Unique boundary for email
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

// Multipart email body
$message = "--$boundary\r\n";
$message .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
$message .= "Content-Transfer-Encoding: 7bit\r\n";
$message .= "\r\n$body\r\n";
$message .= "--$boundary\r\n";
$message .= "Content-Type: application/octet-stream; name=\"$file_name\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n";
$message .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
$message .= "\r\n$file_encoded\r\n";
$message .= "--$boundary--";

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "</fieldset>";
    echo "<div id='success_page'>";
    echo "<h1>Your Message Sent Successfully.</h1>";
    echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us. We will contact you shortly.</p>";
    echo "</div>";
    echo "</fieldset>";
    echo '<a href="index.html">Return to Home</a>';
} else {
    echo '<div class="error_message">ERROR! Email not sent.</div>';
    error_log('Mail error: Unable to send email to ' . $to);
}
?>
