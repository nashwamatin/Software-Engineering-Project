<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self Care Tips</title>
    <style>
    /* Body Styling */
    body {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fce4ec; /* Soft pink background */
    }

    /* Navbar Styling */
    .navbar {
        background-color: #d81b60; /* Cute pink navbar */
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


    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 40px;
        color: #d81b60;
    }

    .tips-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
    }

    .tip {
        background-color: #fff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 30%;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .tip:hover {
        transform: translateY(-5px); 
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .tip h3 {
        font-size: 20px;
        margin: 10px 0;
        color: #d81b60; 
    }

    .tip p {
        font-size: 16px;
        color: #555;
    }

    .tip-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 20px;
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
        <h2>Self Care Tips</h2>

        <div class="tips-container">
            <div class="tip">
                <img src="images/tips/hydration.jpg" alt="Stay Hydrated" class="tip-image">
                <h3>Stay Hydrated</h3>
                <p>Drinking plenty of water is essential for maintaining healthy skin and overall well-being. Make sure to drink at least 8 glasses a day.</p>
            </div>

            <div class="tip">
                <img src="images/tips/sleep.jpg" alt="Get Enough Sleep" class="tip-image">
                <h3>Get Enough Sleep</h3>
                <p>A good night’s sleep is crucial for both mental and physical health. Try to aim for 7-9 hours of sleep each night.</p>
            </div>

            <div class="tip">
                <img src="images/tips/exercise.jpg" alt="Exercise Regularly" class="tip-image">
                <h3>Exercise Regularly</h3>
                <p>Regular exercise is great for your overall health. It improves mood, reduces stress, and strengthens the body.</p>
            </div>

            <div class="tip">
                <img src="images/tips/meditate.jpg" alt="Meditate" class="tip-image">
                <h3>Meditate</h3>
                <p>Take time for yourself to meditate. It helps reduce stress and improves mental clarity and focus.</p>
            </div>
        </div>
    </div>
</body>
</html>
