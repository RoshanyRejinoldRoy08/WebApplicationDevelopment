<?php
session_start();

$cartCount = 0;

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += (int)($item['quantity'] ?? 0);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Foodie - Online Food Delivery</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navigation Bar -->
    <header class="header">

        <div class="container navbar">

            <a href="index.php" class="logo">
                Foodie<span>.</span>
            </a>

            <nav class="nav-links">
                <a href="index.php" class="active">Home</a>
                <a href="menu.php">Menu</a>
                <a href="#about">About</a>
                <a href="#offers">Offers</a>
                <a href="#contact">Contact</a>
            </nav>

            <div class="nav-buttons">
                <a href="cart.php" class="cart-btn">
                    <span>🛒</span>
                    Cart
                    <span class="cart-count">
                        <?php echo $cartCount; ?>
                    </span>
                </a>
            </div>

        </div>

    </header>


    <!-- Hero Section -->
    <section class="hero">

        <div class="container hero-content">

            <div class="hero-text">

                <span class="small-heading">
                    WELCOME TO FOODIE
                </span>

                <h1>
                    Delicious Food,
                    <span>Delivered Fast.</span>
                </h1>

                <p>
                    Discover delicious meals from your favourite
                    restaurants. Order online and enjoy fresh food
                    delivered directly to your doorstep.
                </p>

                <div class="hero-buttons">

                    <a href="menu.php" class="primary-btn">
                        Order Now →
                    </a>

                    <a href="#about" class="secondary-btn">
                        Learn More
                    </a>

                </div>

                <div class="hero-info">

                    <div class="info-item">
                        <h3>100+</h3>
                        <p>Food Items</p>
                    </div>

                    <div class="info-item">
                        <h3>50+</h3>
                        <p>Happy Customers</p>
                    </div>

                    <div class="info-item">
                        <h3>24/7</h3>
                        <p>Online Service</p>
                    </div>

                </div>

            </div>

            <div class="hero-image">

                <div class="image-circle">
                    <div class="food-emoji">🍔</div>
                </div>

                <div class="floating-card">
                    <span>⭐</span>
                    <div>
                        <h4>Fresh & Delicious</h4>
                        <p>Made with love</p>
                    </div>
                </div>

            </div>

        </div>

    </section>


    <!-- Features Section -->
    <section class="features">

        <div class="container feature-container">

            <div class="feature-card">
                <div class="feature-icon">🚚</div>
                <h3>Fast Delivery</h3>
                <p>Get your favourite food delivered quickly.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🥗</div>
                <h3>Fresh Food</h3>
                <p>Enjoy fresh and delicious meals every day.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💳</div>
                <h3>Easy Payment</h3>
                <p>Simple and convenient payment options.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">❤️</div>
                <h3>Best Quality</h3>
                <p>Quality food prepared for our customers.</p>
            </div>

        </div>

    </section>


    <!-- Food Categories -->
    <section class="categories section-padding">

        <div class="container">

            <div class="section-heading">
                <span>EXPLORE OUR FOOD</span>
                <h2>Choose Your Favourite</h2>
                <p>Find something delicious for every craving.</p>
            </div>

            <div class="category-container">

                <a href="menu.php" class="category-card">
                    <div class="category-icon">🍔</div>
                    <h3>Burgers</h3>
                    <p>Delicious burgers</p>
                </a>

                <a href="menu.php" class="category-card">
                    <div class="category-icon">🍕</div>
                    <h3>Pizza</h3>
                    <p>Cheesy and tasty</p>
                </a>

                <a href="menu.php" class="category-card">
                    <div class="category-icon">🍚</div>
                    <h3>Rice</h3>
                    <p>Fresh rice dishes</p>
                </a>

                <a href="menu.php" class="category-card">
                    <div class="category-icon">🍗</div>
                    <h3>Chicken</h3>
                    <p>Favourite chicken meals</p>
                </a>

                <a href="menu.php" class="category-card">
                    <div class="category-icon">🍟</div>
                    <h3>Snacks</h3>
                    <p>Enjoy tasty snacks</p>
                </a>

            </div>

            <div class="center-button">
                <a href="menu.php" class="primary-btn">
                    View Full Menu →
                </a>
            </div>

        </div>

    </section>


    <!-- Special Offer Section -->
    <section class="offer-section" id="offers">

        <div class="container offer-content">

            <div class="offer-text">

                <span class="offer-label">
                    SPECIAL OFFER
                </span>

                <h2>
                    Delicious Moments
                    <span>Start Here!</span>
                </h2>

                <p>
                    Explore our food collection and enjoy
                    delicious meals at affordable prices.
                </p>

                <a href="menu.php" class="offer-btn">
                    Explore Menu →
                </a>

            </div>

            <div class="offer-emoji">
                🍕
            </div>

        </div>

    </section>


    <!-- About Section -->
    <section class="about section-padding" id="about">

        <div class="container about-container">

            <div class="about-image">
                <div class="about-emoji">👨‍🍳</div>
            </div>

            <div class="about-text">

                <span>ABOUT FOODIE</span>

                <h2>
                    We Make Food Ordering
                    Simple & Enjoyable
                </h2>

                <p>
                    Foodie is an online food delivery platform
                    created to make food ordering easy and convenient.
                    Customers can explore different food items,
                    select their favourite meals and place orders online.
                </p>

                <p>
                    Our goal is to provide a simple ordering experience
                    with delicious food and convenient service.
                </p>

                <a href="menu.php" class="primary-btn">
                    Discover More →
                </a>

            </div>

        </div>

    </section>


    <!-- Contact Section -->
    <section class="contact-section section-padding" id="contact">

        <div class="container">

            <div class="section-heading">
                <span>GET IN TOUCH</span>
                <h2>Contact Us</h2>
                <p>We are happy to hear from you.</p>
            </div>

            <div class="contact-container">

                <div class="contact-card">
                    <div>📞</div>
                    <h3>Phone</h3>
                    <p>+94 77 123 4567</p>
                </div>

                <div class="contact-card">
                    <div>📧</div>
                    <h3>Email</h3>
                    <p>support@foodie.com</p>
                </div>

                <div class="contact-card">
                    <div>📍</div>
                    <h3>Location</h3>
                    <p>Sri Lanka</p>
                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="footer">

        <div class="container footer-container">

            <div class="footer-about">

                <a href="index.php" class="footer-logo">
                    Foodie<span>.</span>
                </a>

                <p>
                    Delicious food delivered to your doorstep.
                    Enjoy your favourite meals with Foodie.
                </p>

            </div>

            <div class="footer-links">

                <h3>Quick Links</h3>

                <a href="index.php">Home</a>
                <a href="menu.php">Menu</a>
                <a href="#about">About</a>
                <a href="#offers">Offers</a>
                <a href="#contact">Contact</a>

            </div>

            <div class="footer-links">

                <h3>Our Services</h3>

                <a href="menu.php">Food Ordering</a>
                <a href="cart.php">Shopping Cart</a>
                <a href="checkout.php">Checkout</a>

            </div>

            <div class="footer-social">

                <h3>Follow Us</h3>

                <p>Stay connected with Foodie.</p>

                <div class="social-icons">
                    <a href="#">Facebook</a>
                    <a href="#">Instagram</a>
                </div>

            </div>

        </div>

        <div class="copyright">
            <p>
                &copy; <?php echo date("Y"); ?>
                Foodie. All Rights Reserved.
            </p>
        </div>

    </footer>

</body>
</html>
