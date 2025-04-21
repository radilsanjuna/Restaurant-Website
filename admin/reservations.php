<?php

include '../components/conect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

// MySQLi query to get reservations
$sql = "SELECT * FROM `reservations`";
$reservations_result = mysqli_query($conn, $sql);

// Check if any rows exist and fetch the data
$reservations = [];
if (mysqli_num_rows($reservations_result) > 0) {
    while ($row = mysqli_fetch_assoc($reservations_result)) {
        $reservations[] = $row;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reservations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #ede9e9;
            padding: 20px;
        }

        .reservation-title {
            color: #d6ccc2; 
            margin-bottom: 30px;
            text-align: center;
        }

        table {
            margin: 0 auto;
            width: 80%;
        }

        th {
            background-color: #f5ebe0;
            color: #8b4513;
        }

        tr:hover {
            background-color: #d6ccc2; 
        }
    </style>
</head>
<body>
    <?php include '../components/admin_header.php'; ?>
    <h1 class="reservation-title">Admin Reservations</h1>
    <div class="container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($reservations) > 0) {
                    foreach ($reservations as $row) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . htmlspecialchars($row["phone"]) . "</td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                <td>" . htmlspecialchars($row["date"]) . "</td>
                                <td>" . htmlspecialchars($row["time"]) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>0 results</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        if (count($reservations) === 0) {
            echo '<p class="text-center text-muted">No orders placed yet!</p>';
        }
        ?>
    </div>
</body>
</html>