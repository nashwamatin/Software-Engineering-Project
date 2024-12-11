<?php
// Start session and include DB connection
session_start();
include "db_connection.php";

// Fetch products from the database
$query = "SELECT * FROM products";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self-Care Website</title>
    <style>

    body {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        background-color: #fce4ec; 
        margin: 0;
        padding: 0;
    }


    .container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        border: 2px solid #f48fb1; 
    }


    .navbar {
        background-color: #d81b60; 
        overflow: hidden;
    }

    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
        font-weight: bold;
    }

    .navbar a:hover {
        background-color: #ec407a; 
        color: white;
    }

    .products {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Responsive grid */
        gap: 20px;
        margin-top: 20px;
    }

    .product {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: left;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .product img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
        height: auto;
    }

    .product h3 {
        color: #d81b60; 
        font-size: 20px;
        margin-bottom: 10px;
    }


    .product p {
        color: #555;
        font-size: 16px;
        margin-bottom: 10px;
    }


    .product .price {
        font-size: 18px;
        color: #d81b60; 
        font-weight: bold;
        margin-bottom: 15px;
    }

    button {
        background-color: #d81b60; 
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    button:hover {
        background-color: #ec407a;
    }
</style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
        <a href="services.php">Services</a>
        <a href="selfcaretips.php">Self-Care Tips</a>
        <a href="login.php">Login</a>
    </div>
    <div class="container">
    <h2>Our Products</h2>
    <div class="products">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<img src='images/products/" . $row['ImageURL'] . "' alt='" . $row['Name'] . "'>";
                echo "<h3>" . $row['Name'] . "</h3>";
                echo "<p>" . $row['Description'] . "</p>";
                echo "<p>Price: $" . $row['Price'] . "</p>";
                echo "<form action='cart.php' method='POST'>";
                echo "<input type='hidden' name='product_id' value='" . $row['ProductID'] . "'>";
                echo "<input type='number' name='quantity' value='1' min='1'>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>

