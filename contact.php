<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Define your receiving email address
    $receiving_email_address = 'kiokoeddie254@gmail.com'; // This is where the form submission will be sent

    // 2. Get the submitted email address from the form
    // Use filter_var for basic sanitization to remove illegal characters from the email address
    $submitted_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // 3. Validate the email address
    // Check if the email is empty or not a valid email format
    if (empty($submitted_email) || !filter_var($submitted_email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address to subscribe.";
        exit; // Stop script execution if validation fails
    }

    // 4. Prepare email details
    $subject = "New Email Signup from Your Website"; // Subject line of the email you will receive
    $message = "You have a new email subscriber!\n\n";
    $message .= "Subscriber Email: " . $submitted_email . "\n"; // Body of the email

    // Set headers for the email
    // IMPORTANT: The 'From' address should ideally be from your website's domain
    // Using a @gmail.com address here might cause deliverability issues (spam filters)
    // Replace 'noreply@yourwebsite.com' with an actual email from your domain if possible.
    $headers = "From: noreply@yourwebsite.com\r\n"; // Example: noreply@yourchurchwebsite.com
    $headers .= "Reply-To: " . $submitted_email . "\r\n"; // Allows you to reply directly to the subscriber
    $headers .= "X-Mailer: PHP/" . phpversion(); // Adds information about the PHP version

    // 5. Send the email
    // The mail() function attempts to send the email. It returns true on success, false on failure.
    if (mail($receiving_email_address, $subject, $message, $headers)) {
        // Success message if the email was sent
        echo "Thank you for signing up! Your email has been received.";
        // Optional: Redirect the user to a "thank you" page for a better user experience
        // header("Location: thank_you.html");
        // exit; // Ensure no further code is executed after redirection
    } else {
        // Error message if the email failed to send
        echo "Sorry, there was an error sending your email. Please try again later.";
    }
} else {
    // This block runs if the page is accessed directly, not via form submission
    echo "This page cannot be accessed directly. Please use the form to submit your email.";
}
?>
