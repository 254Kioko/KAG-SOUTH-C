<?php
$amount = $_POST['amount'];
$tillNumber = '803777'; // Your Till Number

// Call your API or perform necessary steps to initiate the payment
// This involves using the Safaricom Daraja API to create a payment request
// Ensure to use proper authentication, encryption, and validation

// Example:
// Here, you would use the Daraja API to create a payment request using $amount and $tillNumber
// You'll receive a response from the API with payment details, including a payment URL or further steps.

// For demonstration purposes, let's assume we got a successful response with a payment URL
$paymentURL = 'https://example.com/payments/confirm'; // Replace this with the actual payment URL

echo $paymentURL; // Send back the payment URL as a response
?>
