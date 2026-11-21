<?php
require_once 'includes/functions.php';

$order = $_SESSION['last_order'] ?? null;

if (!$order) {
    header('Location: index.php');
    exit;
}

unset($_SESSION['last_order']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Successful - Foodie</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="success-page wrap">

    <div class="success-icon">✓</div>

    <h1>Order Placed Successfully!</h1>

    <p>
        Thank you, <?= e($order['name']) ?>.
        Your order has been received.
    </p>

    <div class="summary success-summary">

        <p>
            Order Number
            <b><?= e($order['number']) ?></b>
        </p>

        <p>
            Payment
            <b><?= e($order['payment']) ?></b>
        </p>

        <h2>
            Total
            <span>Rs. <?= number_format($order['total'], 2) ?></span>
        </h2>

    </div>

    <a class="btn" href="menu.php">Continue Shopping</a>

</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>