<?php
session_start();

// ?????? ?? ????? ??????
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Payment Page</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>. You are ready to make a payment.</p>
    <form action="process_payment.php" method="POST">
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>
