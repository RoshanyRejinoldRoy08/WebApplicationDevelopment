<?php
session_start();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function escape($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function getCartTotal($cart) {
    $total = 0;

    foreach ($cart as $item) {
        $total += (float)$item['price'] * (int)$item['quantity'];
    }

    return $total;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['update_cart'])) {

        $foodId = filter_input(INPUT_POST, 'food_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

        if (
            $foodId !== false &&
            $foodId !== null &&
            $quantity !== false &&
            $quantity !== null &&
            isset($_SESSION['cart'][$foodId])
        ) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$foodId]);
            } else {
                $_SESSION['cart'][$foodId]['quantity'] = min($quantity, 99);
            }
        }
    }

    if (isset($_POST['remove_item'])) {

        $foodId = filter_input(INPUT_POST, 'food_id', FILTER_VALIDATE_INT);

        if (
            $foodId !== false &&
            $foodId !== null &&
            isset($_SESSION['cart'][$foodId])
        ) {
            unset($_SESSION['cart'][$foodId]);
        }
    }

    if (isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = [];
    }

    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'];
$cartTotal = getCartTotal($cart);

$cartCount = 0;

foreach ($cart as $item) {
    $cartCount += (int)$item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart - Foodie</title>

    <link rel="stylesheet" href="assets/css/cart.css">
</head>

<body>

<header class="cart-header">

    <div class="container navbar">

        <a href="index.php" class="logo">
            Foodie<span>.</span>
        </a>

        <a href="cart.php" class="cart-link">
            🛒 Cart (<?php echo $cartCount; ?>)
        </a>

    </div>

</header>


<section class="cart-banner">

    <div class="container">
        <h1>My Shopping Cart</h1>
        <p>Review your favourite food before checkout.</p>
    </div>

</section>


<main class="container cart-main">

    <?php if (empty($cart)): ?>

        <div class="empty-cart">

            <div class="empty-icon">🛒</div>

            <h2>Your Cart is Empty</h2>

            <p>
                You haven't added any food items yet.
                Explore our menu and find something delicious!
            </p>

            <a href="menu.php" class="primary-btn">
                Explore Menu
            </a>

        </div>

    <?php else: ?>

        <div class="cart-layout">

            <div class="cart-items-section">

                <div class="cart-title">
                    <h2>Cart Items</h2>
                    <span><?php echo $cartCount; ?> items</span>
                </div>


                <?php foreach ($cart as $foodId => $item): ?>

                    <div class="cart-item">

                        <div class="item-image">

                            <img
                                src="<?php echo escape($item['image'] ?? 'assets/images/food-placeholder.jpg'); ?>"
                                alt="<?php echo escape($item['name']); ?>"
                                onerror="this.onerror=null;this.src='assets/images/food-placeholder.jpg';"
                            >

                        </div>


                        <div class="item-details">

                            <h3>
                                <?php echo escape($item['name']); ?>
                            </h3>

                            <p class="item-price">
                                Rs. <?php echo number_format((float)$item['price'], 2); ?>
                            </p>

                            <form method="POST" action="cart.php" class="quantity-form">

                                <input
                                    type="hidden"
                                    name="food_id"
                                    value="<?php echo (int)$foodId; ?>"
                                >

                                <label for="quantity-<?php echo (int)$foodId; ?>">
                                    Quantity:
                                </label>

                                <input
                                    type="number"
                                    id="quantity-<?php echo (int)$foodId; ?>"
                                    name="quantity"
                                    value="<?php echo (int)$item['quantity']; ?>"
                                    min="1"
                                    max="99"
                                    required
                                >

                                <button
                                    type="submit"
                                    name="update_cart"
                                    class="update-btn"
                                >
                                    Update
                                </button>

                            </form>

                        </div>


                        <div class="item-actions">

                            <h3>
                                Rs.
                                <?php
                                echo number_format(
                                    (float)$item['price'] * (int)$item['quantity'],
                                    2
                                );
                                ?>
                            </h3>

                            <form method="POST" action="cart.php">

                                <input
                                    type="hidden"
                                    name="food_id"
                                    value="<?php echo (int)$foodId; ?>"
                                >

                                <button
                                    type="submit"
                                    name="remove_item"
                                    class="remove-btn"
                                >
                                    Remove
                                </button>

                            </form>

                        </div>

                    </div>

                <?php endforeach; ?>


                <div class="cart-actions">

                    <a href="menu.php" class="continue-btn">
                        ← Continue Shopping
                    </a>

                    <form method="POST" action="cart.php">

                        <button
                            type="submit"
                            name="clear_cart"
                            class="clear-btn"
                            onclick="return confirm('Are you sure you want to clear your cart?');"
                        >
                            Clear Cart
                        </button>

                    </form>

                </div>

            </div>


            <aside class="order-summary">

                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Items</span>
                    <span><?php echo $cartCount; ?></span>
                </div>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>
                        Rs. <?php echo number_format($cartTotal, 2); ?>
                    </span>
                </div>

                <div class="summary-row">
                    <span>Delivery Fee</span>
                    <span>Rs. 0.00</span>
                </div>

                <div class="summary-divider"></div>

                <div class="summary-total">
                    <span>Total</span>
                    <span>
                        Rs. <?php echo number_format($cartTotal, 2); ?>
                    </span>
                </div>

                <a href="checkout.php" class="checkout-btn">
                    Proceed to Checkout →
                </a>

                <p class="secure-note">
                    🔒 Your order details are kept securely.
                </p>

            </aside>

        </div>

    <?php endif; ?>

</main>


<footer class="cart-footer">

    <div class="container">

        <h2>Foodie<span>.</span></h2>

        <p>Delicious food delivered to your doorstep.</p>

        <p class="copyright">
            &copy; <?php echo date('Y'); ?> Foodie. All Rights Reserved.
        </p>

    </div>

</footer>

</body>
</html>