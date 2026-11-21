<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cartCount = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += (int)$item['quantity'];
    }
}
?>

<header class="site-header">
    <div class="header-container">

        <a href="index.php" class="logo">
            Food Delivery
        </a>

        <nav class="navigation">
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="cart.php">
                Cart (<?= $cartCount ?>)
            </a>
        </nav>

    </div>
</header>