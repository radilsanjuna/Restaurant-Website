<?php

include 'components/conect.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        
.about-section {
    display: flex;
    justify-content: center; /* Centers the section horizontally */
    align-items: center; /* Centers the content vertically */
    padding: 50px 0; /* Adds padding for spacing */
    background-color: #ffffff; /* White background color */
}

.about-content {
    display: flex;
    flex-direction: row; /* Arrange image and text side by side */
    align-items: center;
    max-width: 1200px; /* Limits the width of the content */
    margin: 0 20px; /* Adds some horizontal margin */
}

.about-image img {
    width: 100%;
    max-width: 500px; /* Sets a maximum width for the image */
    height: auto;
    border-radius: 10px; /* Optional: adds rounded corners */
    margin-right: 30px; /* Adds space between image and text */
}

.about-text {
    max-width: 600px; /* Sets a maximum width for the text */
}

.about-text h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    text-transform: uppercase;
    color: #333;
}

.about-text h3 {
    font-size: 1.8rem;
    margin-bottom: 15px;
    color: #666;
}

.about-text p {
    font-size: 1.2rem;
    color: #777;
    line-height: 1.6;
}
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.gallery-container {
    padding: 40px;
    text-align: center;
}

.gallery-container h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #fff; /* White text color */
    background-color: #3a3a3a; /* Dark background */
    padding: 10px 20px; /* Padding around text */
    border-radius: 10px; /* Rounded corners */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Text shadow for depth */
    display: inline-block; /* Center the background */
}

.gallery {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* Show 4 images per row */
    gap: 15px;
}

.gallery-item img {
    width:250px;
    height:200px;
    border-radius: 20px; /* Increased border radius for more curvature */
    transition: transform 0.3s;
}

.gallery-item img:hover {
    transform: scale(1.1); /* Slightly increased scale on hover */
}


    </style>
</head>

<body>

<?php
include 'components/user_header.php';

?> 


 
    <!----Showcase open---->
    <main id="showcase">
        <div id="container">
            <div id="content">
              
                <h2>The Gallery Café</h2>
                <h3>Experience Culinary Excellence</h3>
            </div>
        </div>

    </main>
    <!----Showcase close---->

   

    <!-- About Section -->
<div class="about-section">
    <div class="about-content">
        <div class="about-image">
            <img src="images/about.jpg" alt="About Image">
        </div>
        <div class="about-text">
            <h1>About The Gallery Café</h1>
            <h3>Our Story</h3>
            <p>Discover the rich history and culinary excellence of The Gallery Café. From our humble beginnings to becoming a staple of fine dining, we invite you to join us in experiencing a journey of flavors and hospitality.</p>
        </div>
    </div>
</div>
    

    <!----About us close---->


    
    <div class="gallery-container">
    <h1>Photo Gallery</h1>
    <div class="gallery">
        <div class="gallery-item"><img src="images/1" alt="Dish 1"></div>
        <div class="gallery-item"><img src="images/2" alt="Dish 2"></div>
        <div class="gallery-item"><img src="images/3" alt="Dish 3"></div>
        <div class="gallery-item"><img src="images/5" alt="Dish 5"></div>
        <div class="gallery-item"><img src="images/6" alt="Dish 6"></div>
        <div class="gallery-item"><img src="images/7" alt="Dish 7"></div>
        <div class="gallery-item"><img src="images/8" alt="Dish 8"></div>
        <div class="gallery-item"><img src="images/9" alt="Dish 9"></div>   
    </div>
</div>

<?php include 'components/footer.php' ?>

    
    <script src="code.js"></script>
</body>
</html>
