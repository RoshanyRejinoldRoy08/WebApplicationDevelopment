<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$cart = $_SESSION['cart'];
$subtotal = 0;

foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$deliveryFee = 0;
$total = $subtotal + $deliveryFee;

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $payment = $_POST['payment'] ?? '';

    if ($name === "" || $phone === "" || $address === "" || $payment === "") {
        $error = "Please fill in all fields.";
    } elseif (!preg_match('/^[0-9+\-\s]{7,15}$/', $phone)) {
        $error = "Please enter a valid phone number.";
    } elseif (!in_array($payment, ['Cash on Delivery', 'Card Payment'], true)) {
        $error = "Please select a valid payment method.";
    } else {
        $_SESSION['order'] = [
            'order_id' => 'FD' . time(),
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'payment' => $payment,
            'items' => $cart,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $total,
            'date' => date('Y-m-d H:i:s')
        ];

        unset($_SESSION['cart']);

        header("Location: order_success.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Food Delivery</title>
    <link rel="stylesheet" href="assets/css/checkout.css">
</head>
<body>

<header class="header">
    <div class="container">
        <h2>Food Delivery</h2>
        <nav>
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="cart.php">Cart</a>
        </nav>
    </div>
</header>

<main class="container checkout-container">

    <h1>Checkout</h1>
    <p class="subtitle">Complete your details to place your order.</p>

    <?php if ($error !== ""): ?>
        <div class="error-message">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="checkout-grid">

        <section class="checkout-form">
            <h2>Delivery Information</h2>

            <form method="POST" action="checkout.php">

                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                    required
                >

                <label for="phone">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                    required
                >

                <label for="address">Delivery Address</label>
                <textarea
                    id="address"
                    name="address"
                    rows="4"
                    required
                ><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>

                <label for="payment">Payment Method</label>
                <select id="payment" name="payment" required>
                    <option value="">Select Payment Method</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Card Payment">Card Payment</option>
                </select>

                <button type="submit" class="place-order-btn">
                    Place Order
                </button>

            </form>
        </section>

        <section class="order-summary">
            <h2>Order Summary</h2>

            <?php foreach ($cart as $item): ?>
                <div class="summary-item">
                    <div>
                        <strong>
                            <?= htmlspecialchars($item['name']) ?>
                        </strong>
                        <small>Quantity: <?= (int)$item['quantity'] ?></small>
                    </div>

                    <span>
                        Rs. <?= number_format(
                            $item['price'] * $item['quantity'],
                            2
                        ) ?>
                    </span>
                </div>
            <?php endforeach; ?>

            <hr>

            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rs. <?= number_format($subtotal, 2) ?></span>
            </div>

            <div class="summary-row">
                <span>Delivery Fee</span>
                <span>Rs. <?= number_format($deliveryFee, 2) ?></span>
            </div>

            <div class="summary-row total">
                <strong>Total</strong>
                <strong>Rs. <?= number_format($total, 2) ?></strong>
            </div>

        </section>

    </div>
</main>

</body>
</html>