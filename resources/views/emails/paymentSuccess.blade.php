<!DOCTYPE html>
<html>
<head>
    <title>Email Verification Code</title>
</head>
<body>
    <h1>Payment Successful</h1>
    <p>Dear {{ $userName }},</p>
    <p>Thank you for your purchase. Your order #{{ $order->order_number }} has been successfully processed.</p>
</body>
</html>