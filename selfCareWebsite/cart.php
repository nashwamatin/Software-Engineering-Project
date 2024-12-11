<?php
session_start();
include "db_connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];


    $query = "SELECT * FROM `orders` WHERE UserID = ? AND ProductID = ? AND OrderStatus = 'Pending'";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        $new_quantity = $order['Quantity'] + $quantity;
        $update_query = "UPDATE `orders` SET Quantity = ? WHERE OrderID = ?";
        $stmt_update = $connection->prepare($update_query);
        $stmt_update->bind_param("ii", $new_quantity, $order['OrderID']);
        $stmt_update->execute();
    } else {
        $query = "INSERT INTO `orders` (UserID, ProductID, Quantity, OrderDate, OrderStatus) VALUES (?, ?, ?, NOW(), 'Pending')";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt_insert->execute();
    }
}

$query = "SELECT o.OrderID, o.Quantity, p.Name, p.Price, p.ImageURL FROM `orders` o INNER JOIN products p ON o.ProductID = p.ProductID WHERE o.UserID = ? AND o.OrderStatus = 'Pending'";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
    body {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        background-color: #fce4ec;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 900px;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border: 2px solid #f48fb1;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        border: 1px solid #f48fb1; 
        padding: 12px;
        text-align: center;
    }

    table th {
        background-color: #d81b60; 
        color: white;
    }

    button {
        padding: 12px 24px;
        background-color: #d81b60; 
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 8px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #ec407a; 
    }


    .button-container {
        text-align: center;
        margin-top: 20px;
    }

    h1 {
        color: #d81b60; 
        text-align: center;
        font-size: 2em;
        margin-bottom: 20px;
    }

    p {
        text-align: center;
        font-size: 16px;
        color: #555;
    }


    .empty-cart-message {
        text-align: center;
        color: #d81b60; 
        font-size: 18px;
        font-weight: bold;
    }
</style>

</head>
<body>
    <div class="container">
        <h2>Your Cart</h2>
        <?php if ($cart_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            $total = 0;
            while ($cart_item = $cart_result->fetch_assoc()) {
                $item_total = $cart_item['Price'] * $cart_item['Quantity'];
                $total += $item_total;
                echo "<tr>";
                echo "<td><img src='images/products/" . $cart_item['ImageURL'] . "' alt='" . $cart_item['Name'] . "' width='50'> " . $cart_item['Name'] . "</td>";
                echo "<td>$" . $cart_item['Price'] . "</td>";
                echo "<td>" . $cart_item['Quantity'] . "</td>";
                echo "<td>$" . number_format($item_total, 2) . "</td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="3"><strong>Total:</strong></td>
                <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
            </tr>
        </table>
        <br>
        <form action="checkout.php" method="POST">
            <button type="submit" name="checkout">Proceed to Checkout</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
    </div>
</body>
</html>

