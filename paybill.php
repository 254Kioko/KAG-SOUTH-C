<?php
// M-Pesa API credentials
$consumer_key = 'your_consumer_key';
$consumer_secret = 'your_consumer_secret';
$paybill_number = '247247'; // Paybill number
$lipa_na_mpesa_online_passkey = 'your_passkey';
$shortcode = 'your_shortcode';
$shortcode_phone = 'your_shortcode_phone';

// Access token generation
$credentials = base64_encode($consumer_key . ':' . $consumer_secret);
$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
curl_close($curl);

$response = json_decode($result);
$access_token = $response->access_token;

// Paybill request
$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$timestamp = date('YmdHis');
$passwd = base64_encode($shortcode . $lipa_na_mpesa_online_passkey . $timestamp);

$request_payload = [
    'BusinessShortCode' => $paybill_number,
    'Password' => $passwd,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => '100', // The amount to be paid
    'PartyA' => $shortcode_phone,
    'PartyB' => $paybill_number,
    'PhoneNumber' => '2547xxxxxxxx', // Customer's phone number
    'CallBackURL' => 'https://your_callback_url.com',
    'AccountReference' => '1280298934050', // Account number
    'TransactionDesc' => 'Payment for services'
];

$request_data = json_encode($request_payload);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $request_data);

$result = curl_exec($curl);
curl_close($curl);

$response = json_decode($result);
// Use the response to handle further actions (like displaying payment details or handling errors)
print_r($response);
?>
