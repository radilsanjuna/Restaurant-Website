<?php

include 'components/conect.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['date']) && isset($_POST['time'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO `reservations` (name, phone, email, date, time) VALUES ('$name', '$phone', '$email', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation saved successfully!";
    }
}
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #FFFAFA;
        }

        .heading h3 {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            color: black; 
            font-size: 3rem; 
            margin-bottom: 25px;
            padding-top: 120px;
           
        }

        .res-offer {
            text-align: center;
            margin-top: 2rem;
            font-size: 2rem;
            font-family: 'Roboto', sans-serif;
            color: black;
        }

        .reservation-form {
            background: #FFCC00; /* Changed background color */
            padding: 3rem; /* Increased padding */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 40rem; /* Changed size */
            margin: 0 auto; /* Centered */
        }
    </style>
   
</head>
<body>
    <!--header start-->
    <?php include 'components/user_header.php' ?>
    <!--header end-->

    <div class="heading">
        <h3>Reserve your table now...</h3>
    </div>

    <!--reservation start-->
    <div class="container">
        <form action="reservations.php" method="post" class="reservation-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>

            <button type="submit" class="btn btn-dark btn-block">Submit</button>
        </form>
    </div>
    
    <p class="res-offer">Offers available for early reservations<br></p>
    <!--reservation end-->

    <?php include 'components/footer.php' ?>
     
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="JS/Script.js"></script>
</body>
</html>