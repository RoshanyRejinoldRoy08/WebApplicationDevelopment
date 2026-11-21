<?php
require_once 'includes/functions.php';

$order = $_SESSION['order'] ?? null;

if (!$order || !is_array($order)) {
    header('Location: index.php');
    exit;
}

unset($_SESSION['order']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Successful - Food Delivery</title>
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="success-container">
    <div class="success-card">

        <div class="success-icon">✓</div>

        <h1>Order Placed Successfully!</h1>

        <p>
            Thank you, <?= e($order['name']) ?>.
            Your order has been received.
        </p>

        <div class="order-details">
            <p>
                <span>Order Number</span>
                <strong><?= e($order['order_id']) ?></strong>
            </p>

            <p>
                <span>Payment</span>
                <strong><?= e($order['payment']) ?></strong>
            </p>

            <p>
                <span>Total</span>
                <strong>Rs. <?= number_format($order['total'], 2) ?></strong>
            </p>
        </div>

        <a class="home-btn" href="menu.php">Continue Shopping</a>

    </div>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>