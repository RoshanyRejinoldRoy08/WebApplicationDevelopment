<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$foods = [
    [
        "id" => 1,
        "name" => "Chicken Burger",
        "description" => "Delicious chicken burger with fresh vegetables.",
        "price" => 850,
        "image" => "assets/images/burger.jpg"
    ],
    [
        "id" => 2,
        "name" => "Chicken Pizza",
        "description" => "Fresh pizza topped with cheese and chicken.",
        "price" => 1500,
        "image" => "assets/images/pizza.jpg"
    ],
    [
        "id" => 3,
        "name" => "Fried Rice",
        "description" => "Tasty fried rice with chicken and vegetables.",
        "price" => 950,
        "image" => "assets/images/fried-rice.jpg"
    ],
    [
        "id" => 4,
        "name" => "French Fries",
        "description" => "Crispy and delicious golden french fries.",
        "price" => 450,
        "image" => "assets/images/fries.jpg"
    ],
    [
        "id" => 5,
        "name" => "Chicken Kottu",
        "description" => "Traditional Sri Lankan chicken kottu.",
        "price" => 1000,
        "image" => "assets/images/kottu.jpg"
    ],
    [
        "id" => 6,
        "name" => "Sandwich",
        "description" => "Fresh sandwich with chicken and vegetables.",
        "price" => 600,
        "image" => "assets/images/sandwich.jpg"
    ]
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) {
    $foodId = (int) $_POST["food_id"];

    foreach ($foods as $food) {
        if ($food["id"] === $foodId) {
            if (isset($_SESSION['cart'][$foodId])) {
                $_SESSION['cart'][$foodId]['quantity']++;
            } else {
                $_SESSION['cart'][$foodId] = [
                    "id" => $food["id"],
                    "name" => $food["name"],
                    "price" => $food["price"],
                    "image" => $food["image"],
                    "quantity" => 1
                ];
            }

            break;
        }
    }

    header("Location: index.php#menu");
    exit;
}

$cartCount = 0;

foreach ($_SESSION['cart'] as $item) {
    $cartCount += $item['quantity'];
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

<!-- Navigation -->
<header class="header">
    <div class="container">
        <h1 class="logo">Foodie<span>.</span></h1>

        <nav>
            <a href="index.php">Home</a>
            <a href="#menu">Menu</a>
            <a href="#offers">Offers</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="cart.php">
                Cart (<?php echo $cartCount; ?>)
            </a>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h2>Delicious Food Delivered To Your Door</h2>

            <p>
                Enjoy your favourite meals prepared fresh
                and delivered quickly to your home.
            </p>

            <a href="#menu" class="btn">Order Now</a>
        </div>
    </div>
</section>

<!-- Food Menu -->
<section class="menu-section" id="menu">

    <div class="container">

        <h2 class="section-title">Our Popular Foods</h2>

        <p class="section-description">
            Choose your favourite food from our delicious menu.
        </p>

        <div class="food-container">

            <?php foreach ($foods as $food): ?>

                <div class="food-card">

                    <img
                        src="<?php echo htmlspecialchars($food['image']); ?>"
                        alt="<?php echo htmlspecialchars($food['name']); ?>"
                        onerror="this.src='assets/images/food-placeholder.jpg'"
                    >

                    <div class="food-details">

                        <h3>
                            <?php echo htmlspecialchars($food['name']); ?>
                        </h3>

                        <p>
                            <?php echo htmlspecialchars($food['description']); ?>
                        </p>

                        <h4>
                            Rs. <?php echo number_format($food['price'], 2); ?>
                        </h4>

                        <form method="POST" action="index.php#menu">

                            <input
                                type="hidden"
                                name="food_id"
                                value="<?php echo $food['id']; ?>"
                            >

                            <button
                                type="submit"
                                name="add_to_cart"
                                class="btn"
                            >
                                Add to Cart
                            </button>

                        </form>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- Offers Section -->
<section class="offers" id="offers">

    <div class="container">

        <h2>Special Offers</h2>

        <p>
            Enjoy delicious meals at affordable prices.
            Special discounts are available on selected items.
        </p>

        <a href="#menu" class="btn">Explore Menu</a>

    </div>

</section>

<!-- About Section -->
<section class="about" id="about">

    <div class="container">

        <h2 class="section-title">About Foodie</h2>

        <p>
            Foodie is an online food delivery platform designed
            to make ordering food simple and convenient.
            Customers can explore food items, add products
            to their cart and place orders online.
        </p>

    </div>

</section>

<!-- Contact Section -->
<section class="contact" id="contact">

    <div class="container">

        <h2 class="section-title">Contact Us</h2>

        <p>Email: support@foodie.com</p>

        <p>Phone: +94 77 123 4567</p>

        <p>Location: Sri Lanka</p>

    </div>

</section>

<!-- Footer -->
<footer class="footer">

    <div class="container">

        <p>
            &copy; <?php echo date("Y"); ?> Foodie.
            All Rights Reserved.
        </p>

    </div>

</footer>

<script src="assets/js/script.js"></script>

</body>
</html>