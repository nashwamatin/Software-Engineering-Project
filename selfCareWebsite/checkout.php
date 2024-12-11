<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
    body {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        background-color: #fce4ec; 
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border: 2px solid #f48fb1; /
    }

    h2 {
        text-align: center;
        color: #d81b60; 
        font-size: 1.8em;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #d81b60; 
        font-weight: bold;
    }

  
    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
    }

    input:focus {
        border-color: #d81b60; 
        outline: none;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #d81b60; 
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #ec407a; 
    }
</style>

</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <form id="paymentForm" onsubmit="return false;"> 
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>
            <br>

            <label for="expiry_date">Expiry Date:</label>
            <input type="text" id="expiry_date" name="expiry_date" required>
            <br>

            <button type="button" onclick="processPayment()">Submit Payment</button>
        </form>
    </div>

    <script>
        function processPayment() {
            var cardNumber = document.getElementById('card_number').value;
            var expiryDate = document.getElementById('expiry_date').value;


            if (cardNumber.length !== 16) {
                alert("Invalid card number. Card number must be 16 digits.");
                return; 
            }

            alert("Payment Successful! Redirecting to Home Page...");


            setTimeout(function() {
                window.location.href = "index.php";  
            }, 2000); 
        }
    </script>

</body>
</html>

