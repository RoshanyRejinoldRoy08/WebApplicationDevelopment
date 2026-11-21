<?php
session_start();

if (!isset($_SESSION['order'])) {
    header("Location: index.php");
    exit();
}

$order = $_SESSION['order'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>

<header class="header">
    <div class="container">
        <h2>Food Delivery</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
        </nav>
    </div>
</header>

<main class="success-container">

    <div class="success-card">
        <div class="success-icon">✓</div>

        <h1>Order Placed Successfully!</h1>

        <p>Thank you, <?= htmlspecialchars($order['name']) ?>.</p>
        <p>Your order has been received.</p>

        <div class="order-details">
            <p>
                <strong>Order ID:</strong>
                <?= htmlspecialchars($order['order_id']) ?>
            </p>

            <p>
                <strong>Phone:</strong>
                <?= htmlspecialchars($order['phone']) ?>
            </p>

            <p>
                <strong>Address:</strong>
                <?= nl2br(htmlspecialchars($order['address'])) ?>
            </p>

            <p>
                <strong>Payment:</strong>
                <?= htmlspecialchars($order['payment']) ?>
            </p>

            <p>
                <strong>Total:</strong>
                Rs. <?= number_format($order['total'], 2) ?>
            </p>

            <p>
                <strong>Date:</strong>
                <?= htmlspecialchars($order['date']) ?>
            </p>
        </div>

        <h3>Ordered Items</h3>

        <?php foreach ($order['items'] as $item): ?>
            <div class="success-item">
                <span>
                    <?= htmlspecialchars($item['name']) ?>
                    × <?= (int)$item['quantity'] ?>
                </span>

                <span>
                    Rs. <?= number_format(
                        $item['price'] * $item['quantity'],
                        2
                    ) ?>
                </span>
            </div>
        <?php endforeach; ?>

        <a href="menu.php" class="home-btn">Continue Shopping</a>
    </div>

</main>

</body>
</html>