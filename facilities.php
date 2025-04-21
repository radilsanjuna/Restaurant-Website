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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Facilities</title>
</head>
<style>

    #container1
    {
        display: flex;
    flex-direction: column;
    gap: 20px;

    }
    </style>
<body>

<?php include 'components/user_header.php'; ?> 

<aside id="facility">
    <h1>Cafe Gallery Amenities</h1>
    <div id="container1">
        <div id="facility_content">
            <div class="facility_item">
                <div class="left_side_content">
                    <h2>Artistic Dining Area</h2>
                    <p>Indulge in a culinary journey within our artistic dining space, where local artwork enhances the ambiance and elevates your dining experience.</p>
                </div>
                <div class="right_side_content">
                    <img class="fac" src="images/faci.jpg" alt="Artistic Dining Area">
                </div>
            </div>

            <div class="facility_item">
                <div class="left_side_content">
                    <h2>Barista Corner</h2>
                    <p>Savor the finest brews at our Barista Corner, where passionate baristas prepare your favorite drinks with care and expertise.</p>
                </div>
                <div class="right_side_content">
                    <img class="fac" src="Images/barista_corner.jpg" alt="Barista Corner">
                </div>
            </div>

            <div class="facility_item">
                <div class="left_side_content">
                    <h2>Outdoor Patio</h2>
                    <p>Unwind in our inviting outdoor patio, a perfect spot for enjoying a sunny day surrounded by lush greenery and good company.</p>
                </div>
                <div class="right_side_content">
                    <img class="fac" src="Images/outdoor_patio.jpg" alt="Outdoor Patio">
                </div>
            </div>

            <div class="facility_item">
                <div class="left_side_content">
                    <h2>Live Music Stage</h2>
                    <p>Experience the vibrancy of live music every weekend, featuring talented local artists that create an unforgettable atmosphere.</p>
                </div>
                <div class="right_side_content">
                    <img class="fac" src="Images/live_music_stage.jpg" alt="Live Music Stage">
                </div>
            </div>

         
        </div>
    </div>
</aside>

<?php include 'components/footer.php'; ?>

<script src="code.js"></script>
</body>
</html>