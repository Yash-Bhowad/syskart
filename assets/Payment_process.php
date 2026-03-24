<?php
$payment_id = $_GET['payment_id'] ?? '';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
    <style>
        body { font-family: Arial; text-align: center; background: #f4f4f4; padding: 50px; }
        .box {
            background: white;
            padding: 30px;
            max-width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success { color: green; }
        .fail { color: red; }
    </style>
</head>
<body>
<div class='box'>";

if (!empty($payment_id)) {
    echo "<h2 class='success'>Payment Successful!</h2>";
    echo "<p>Your Razorpay Payment ID: <strong>$payment_id</strong></p>";
} else {
    echo "<h2 class='fail'>Payment Failed or Cancelled</h2>";
}

echo "</div></body></html>";
?>
