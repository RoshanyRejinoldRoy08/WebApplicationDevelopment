<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$foods = [
    [
        "id" => 1,
        "name" => "Chicken Burger",
        "category" => "Burger",
        "description" => "Delicious chicken burger with fresh vegetables.",
        "price" => 850,
        "image" => "assets/images/burger.jpg"
    ],
    [
        "id" => 2,
        "name" => "Chicken Pizza",
        "category" => "Pizza",
        "description" => "Fresh pizza topped with cheese and chicken.",
        "price" => 1500,
        "image" => "assets/images/pizza.jpg"
    ],
    [
        "id" => 3,
        "name" => "Fried Rice",
        "category" => "Rice",
        "description" => "Tasty fried rice with chicken and vegetables.",
        "price" => 950,
        "image" => "assets/images/fried-rice.jpg"
    ],
    [
        "id" => 4,
        "name" => "French Fries",
        "category" => "Snacks",
        "description" => "Crispy and delicious golden french fries.",
        "price" => 450,
        "image" => "assets/images/fries.jpg"
    ],
    [
        "id" => 5,
        "name" => "Chicken Kottu",
        "category" => "Rice",
        "description" => "Traditional Sri Lankan chicken kottu.",
        "price" => 1000,
        "image" => "assets/images/kottu.jpg"
    ],
    [
        "id" => 6,
        "name" => "Chicken Sandwich",
        "category" => "Snacks",
        "description" => "Fresh sandwich with chicken and vegetables.",
        "price" => 600,
        "image" => "assets/images/sandwich.jpg"
    ],
    [
        "id" => 7,
        "name" => "Cheese Burger",
        "category" => "Burger",
        "description" => "Juicy burger with melted cheese.",
        "price" => 950,
        "image" => "assets/images/cheese-burger.jpg"
    ],
    [
        "id" => 8,
        "name" => "Vegetable Pizza",
        "category" => "Pizza",
        "description" => "Delicious pizza with fresh vegetables.",
        "price" => 1200,
        "image" => "assets/images/vegetable-pizza.jpg"
    ],
    [
        "id" => 9,
        "name" => "Chicken Fried Rice",
        "category" => "Rice",
        "description" => "Special chicken fried rice.",
        "price" => 1100,
        "image" => "assets/images/chicken-rice.jpg"
    ],
    [
        "id" => 10,
        "name" => "Chicken Wings",
        "category" => "Chicken",
        "description" => "Tasty and crispy chicken wings.",
        "price" => 900,
        "image" => "assets/images/chicken-wings.jpg"
    ],
    [
        "id" => 11,
        "name" => "Grilled Chicken",
        "category" => "Chicken",
        "description" => "Freshly prepared grilled chicken.",
        "price" => 1400,
        "image" => "assets/images/grilled-chicken.jpg"
    ],
    [
        "id" => 12,
        "name" => "Chicken Roll",
        "category" => "Snacks",
        "description" => "Delicious crispy chicken roll.",
        "price" => 300,
        "image" => "assets/images/chicken-roll.jpg"
    ]
];

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_to_cart"])) {

    $foodId = filter_input(INPUT_POST, "food_id", FILTER_VALIDATE_INT);

    foreach ($foods as $food) {

        if ($foodId === $food["id"]) {

            if (isset($_SESSION["cart"][$foodId])) {

                $_SESSION["cart"][$foodId]["quantity"]++;

            } else {

                $_SESSION["cart"][$foodId] = [
                    "id" => $food["id"],
                    "name" => $food["name"],
                    "price" => $food["price"],
                    "image" => $food["image"],
                    "quantity" => 1
                ];
            }

            $message = $food["name"] . " added to cart!";
            break;
        }
    }
}

$cartCount = 0;

foreach ($_SESSION["cart"] as $item) {
    $cartCount += (int)$item["quantity"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Menu - Foodie</title>

    <link rel="stylesheet" href="assets/css/menu.css">
</head>

<body>

<header class="menu-header">

    <div class="menu-container navbar">

        <a href="index.php" class="logo">
            Foodie<span>.</span>
        </a>

        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="menu.php" class="active">Menu</a>
            <a href="index.php#about">About</a>
            <a href="index.php#offers">Offers</a>
            <a href="index.php#contact">Contact</a>
        </nav>

        <a href="cart.php" class="cart-button">
            🛒 Cart
            <span><?php echo $cartCount; ?></span>
        </a>

    </div>

</header>


<section class="menu-hero">

    <div class="menu-container">

        <span class="subtitle">OUR FOOD COLLECTION</span>

        <h1>Explore Our <span>Delicious Menu</span></h1>

        <p>
            Discover your favourite meals and order fresh,
            delicious food online.
        </p>

    </div>

</section>


<section class="food-menu-section">

    <div class="menu-container">

        <?php if ($message !== ""): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($message); ?>
                <a href="cart.php">View Cart</a>
            </div>
        <?php endif; ?>

        <div class="menu-heading">

            <div>
                <h2>Our Popular Foods</h2>
                <p>Choose your favourite food from our menu.</p>
            </div>

            <input
                type="search"
                id="foodSearch"
                placeholder="Search food..."
                aria-label="Search food"
            >

        </div>


        <div class="category-filters">

            <button class="filter-btn active" data-category="all">
                All Foods
            </button>

            <button class="filter-btn" data-category="Burger">
                Burgers
            </button>

            <button class="filter-btn" data-category="Pizza">
                Pizza
            </button>

            <button class="filter-btn" data-category="Rice">
                Rice
            </button>

            <button class="filter-btn" data-category="Chicken">
                Chicken
            </button>

            <button class="filter-btn" data-category="Snacks">
                Snacks
            </button>

        </div>


        <div class="food-grid" id="foodGrid">

            <?php foreach ($foods as $food): ?>

                <div
                    class="food-card"
                    data-category="<?php echo htmlspecialchars($food["category"]); ?>"
                    data-name="<?php echo htmlspecialchars(strtolower($food["name"])); ?>"
                >

                    <div class="food-image">

                        <img
                            src="<?php echo htmlspecialchars($food["image"]); ?>"
                            alt="<?php echo htmlspecialchars($food["name"]); ?>"
                            onerror="this.onerror=null;this.src='assets/images/food-placeholder.jpg';"
                        >

                        <span class="food-category">
                            <?php echo htmlspecialchars($food["category"]); ?>
                        </span>

                    </div>


                    <div class="food-details">

                        <h3>
                            <?php echo htmlspecialchars($food["name"]); ?>
                        </h3>

                        <p>
                            <?php echo htmlspecialchars($food["description"]); ?>
                        </p>

                        <div class="food-bottom">

                            <span class="food-price">
                                Rs. <?php echo number_format($food["price"], 2); ?>
                            </span>

                            <form method="POST" action="menu.php">

                                <input
                                    type="hidden"
                                    name="food_id"
                                    value="<?php echo $food["id"]; ?>"
                                >

                                <button
                                    type="submit"
                                    name="add_to_cart"
                                    class="add-cart-btn"
                                >
                                    + Add
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <p id="noResults" class="no-results" hidden>
            No food items found.
        </p>

    </div>

</section>


<footer class="menu-footer">

    <div class="menu-container">

        <h2>Foodie<span>.</span></h2>

        <p>
            Delicious food delivered to your doorstep.
        </p>

        <p class="copyright">
            &copy; <?php echo date("Y"); ?> Foodie.
            All Rights Reserved.
        </p>

    </div>

</footer>


<script>
const filterButtons = document.querySelectorAll(".filter-btn");
const foodCards = document.querySelectorAll(".food-card");
const searchInput = document.getElementById("foodSearch");
const noResults = document.getElementById("noResults");

let selectedCategory = "all";

function filterFoods() {

    const searchValue = searchInput.value.toLowerCase().trim();
    let visibleCount = 0;

    foodCards.forEach(function(card) {

        const category = card.dataset.category;
        const name = card.dataset.name;

        const categoryMatch =
            selectedCategory === "all" ||
            category === selectedCategory;

        const searchMatch = name.includes(searchValue);

        if (categoryMatch && searchMatch) {
            card.style.display = "block";
            visibleCount++;
        } else {
            card.style.display = "none";
        }

    });

    noResults.hidden = visibleCount !== 0;
}

filterButtons.forEach(function(button) {

    button.addEventListener("click", function() {

        filterButtons.forEach(function(btn) {
            btn.classList.remove("active");
        });

        button.classList.add("active");

        selectedCategory = button.dataset.category;

        filterFoods();

    });

});

searchInput.addEventListener("input", filterFoods);
</script>

</body>
</html>