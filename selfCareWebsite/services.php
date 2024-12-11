<?php
session_start();
include 'db_connection.php';  
$query = "SELECT ServiceID, Name FROM services"; 
$result = $connection->query($query);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_SESSION['user_id'];  
    $serviceID = $_POST['service_id'];  
    $appointmentDate = $_POST['appointment_date'];  
    $appointmentStatus = "Pending"; 
    $query = "INSERT INTO appointments (UserID, ServiceID, AppointmentDate, AppointmentStatus) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("iiss", $userID, $serviceID, $appointmentDate, $appointmentStatus);

    if ($stmt->execute()) {
        echo "Appointment successfully created.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <style>
    body {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        background-color: #fce4ec;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        font-size: 36px;
        color: #d81b60; 
        margin-bottom: 20px;
    }

    .services {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .service {
        padding: 15px;
        background-color: #fff;
        border: 1px solid #f48fb1; 
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .service:hover {
        transform: translateY(-5px); 
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .service img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

 
    .service h3 {
        font-size: 24px;
        color: #d81b60; 
        margin-top: 15px;
    }

    .service p {
        font-size: 14px;
        color: #666;
        margin: 10px 0;
    }

    .service .price {
        font-size: 18px;
        color: #4CAF50; 
        font-weight: bold;
    }

    #calendar {
        text-align: center;
        margin-top: 30px;
    }

    #calendar h3 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
    }

    #calendar input[type="date"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
        width: 250px;
    }

    #calendar button {
        padding: 10px 20px;
        background-color: #d81b60; 
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    #calendar button:hover {
        background-color: #ec407a; 
    }

    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 100;
        width: 300px;
        text-align: center;
        border-radius: 8px;
    }

    .popup button {
        padding: 10px;
        background-color: #d81b60; 
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
    }

    .popup button:hover {
        background-color: #ec407a; 
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
    }

    .navbar a:hover {
        background-color: #ec407a;
        color: white;
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
    <h2>Our Services</h2>
     
        <div class="services">
            <?php
            $query = "SELECT * FROM services";  
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                while ($service = $result->fetch_assoc()) {
                    echo '<div class="service">';
                    echo '<img src="images/services/' . htmlspecialchars($service['ImageURL']) . '" alt="' . htmlspecialchars($service['Name']) . '">';
                    echo '<h3>' . htmlspecialchars($service['Name']) . '</h3>';
                    echo '<p>' . htmlspecialchars($service['Description']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p>No services available at the moment.</p>";
            }
            ?>
        </div>

        <div id="calendar">
            <h3>Book an Appointment</h3>
 <form action="services.php" method="POST">
                <label for="service_id">Choose a Service:</label>
                <select name="service_id" id="service_id" required>
                    <?php
                    $result = $connection->query($query); 
                    if ($result === false) {
                        echo "<option>Error fetching services.</option>";
                    } else if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['ServiceID'] . "'>" . $row['ServiceName'] . "</option>";
                        }
                    } else {
                        echo "<option>No services available</option>";
                    }
                    ?>
                </select>
                <br>

                <label for="appointment_date">Choose Appointment Date:</label>
                <input type="date" name="appointment_date" id="appointment_date" required>
                <br>

                <button type="submit">Book Appointment</button>
            </form>
        </div>
    </div>
</body>
</html>

