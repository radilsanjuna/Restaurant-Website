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
    <title>Signature Cuisine</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php
include 'components/user_header.php'
?> 
    <!----Header start---->
    <!--header>
    <header>
        <div id="container">
          <div id="navbar">
             <div id="logo">
                <a href="./index.html"><img src="Images/signature-cuisine-low-resolution-logo-white-on-transparent-background.png" alt="Signature Cuisine"></a>
             </div>
            <nav>
                <li> <a href="./index.html">Home</a></li>
                <li> <a href="menu.php">Products/Services</a></li>
                <li> <a href="./facilities.html">Facilities</a></li>
                <li> <a href="./gallery.html">Gallery</a></li>
                <li> <a href="./reservations.php">Reservations</a></li>
                <li> <a href="./cart.php">cart</a></li>
             </nav>
        </div>
    </div>
    </header>

</!--Header end-->
    <!--header>

    <!/----Images Open---->
    <div class="gallery">
        <div class="image">
            <img src="Images/Restaurant 01.jpg" alt="Negombo branch">
        </div>
        <div class="image">
            <img src="Images/Restuarant 02.jpg" alt="Colombo-01 branch">
        </div>
        <div class="image">
            <img src="Images/Restuarant 03.jpg" alt="Dehiwala-Mount Lavinia branch">
        </div>
        <div class="image">
            <img src="Images/rooftop lounge.jpeg" alt="Rooftop Lounge">
        </div>
        <div class="image">
            <img src="Images/bar.jpeg" alt="Bar">
        </div>
        <div class="image">
            <img src="Images/crew.jpeg" alt="The Crew">
        </div>
        <div class="image">
            <img src="Images/seafood fried rice.jpg" alt="Seafood Fried Rice">
        </div>
        <div class="image">
            <img src="Images/strawberry bubbele tea.jpg" alt="Strawberry Bubbele Tea">
        </div>
        <div class="image">
            <img src="Images/salami pizza.jpg" alt="Salami Pizza">
        </div>
        <div class="image">
            <img src="Images/biscuit-pudding.jpg" alt="Biscuit-Pudding">
        </div>
        <div class="image">
            <img src="Images/blueberry_green_tea_bubble_tea.jpg" alt="Blueberry_green_tea_bubble_tea">
        </div>
        <div class="image">
            <img src="Images/Beef-Fried-Rice.jpg" alt="Beef-Fried-Rice">
        </div>
        <div class="image">
            <img src="Images/Beef-Hamburgers.jpg" alt="Beef-Hamburgers">
        </div>
        <div class="image">
            <img src="Images/Buffalo-Chicken-Pizza.jpg" alt="Buffalo-Chicken-Pizza">
        </div>
        <div class="image">
            <img src="Images/prawn burger.jpg" alt="prawn burger">
        </div>
        <div class="image">
            <img src="Images/Chicken cheesy burger.jpg" alt="Chicken cheesy burger">
        </div>
        <div class="image">
            <img src="Images/cheesecake.jpg" alt="cheesecake">
        </div>
        <div class="image">
            <img src="Images/chicken fried rice.jpg" alt="chicken fried rice">
        </div>
        <div class="image">
            <img src="Images/Chicken-Alfredo pasta.jpg" alt="Chicken-Alfredo pasta">
        </div>
        </div>
    
    </div>
    
    <div class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modal-image">
    </div>
    <!----Images close---->


    <?php include 'components/footer.php' ?>


    
    <script src="code.js"></script>
</body>
</html>
