<?php
// Start session
session_start();
include "db_connection.php";
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
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        border: 2px solid #f48fb1;
    }

    h1 {
        margin-bottom: 20px;
        color: #d81b60; 
    }

    p {
        margin-bottom: 20px;
        color: #333;
    }

  
    a {
        color: #d81b60; 
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
        color: #c2185b; 
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

    .products, .services {
        display: inline-block;
        width: 45%;
        vertical-align: top;
        margin: 10px;
    }

    .product, .service {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: left;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product:hover, .service:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .product img, .service img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
        height: auto;
    }

    .product h3, .service h3 {
        color: #d81b60;
        font-size: 20px;
        margin-bottom: 10px;
    }

    .product p, .service p {
        color: #555;
        font-size: 16px;
        margin-bottom: 10px;
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
        <a href="services.php">Services</a>
        <a href="selfcaretips.php">Self-Care Tips</a>
        <a href="login.php">Login</a>
    </div>
    <div class="container">
        <h1>Welcome to Our Self-Care Website</h1>
        <p>Explore our products, services, and self-care tips!</p>
        <h2>Our Products</h2>
        <div class="products">
            <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    echo "<img src='images/products/" . $row['ImageURL'] . "' alt='" . $row['Name'] . "'>";
                    echo "<h3>" . $row['Name'] . "</h3>";
                    echo "<p>" . $row['Description'] . "</p>";
                    echo "<p>Price: $" . $row['Price'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No products available.";
            }
            ?>
        </div>
        <h2>Our Services</h2>
        <div class="services">
            <?php
            $query = "SELECT * FROM services";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='service'>";
                    echo "<img src='images/services/" . $row['ImageURL'] . "' alt='" . $row['Name'] . "'>";
                    echo "<h3>" . $row['Name'] . "</h3>";
                    echo "<p>" . $row['Description'] . "</p>";
                    echo "<p>Price: $" . $row['Price'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No services available.";
            }
            ?>
        </div>
    </div>
</body>
</html>
