<?php

include '../components/conect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_styles.css">
   <style>
      body {
    font-family: 'Arial', sans-serif;
    background-color: #FDF5E6; 
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.dashboard {
    text-align: center;
}

.heading {
    color: #FFA500;
}

.box-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 30px;
}

.box {
    background-color: #FFDAB9; 
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

.box h3 {
    color: #FF8C00; 
}

.box p {
    color: #8B4513; 
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    margin-top: 15px;
    text-decoration: none;
    color: #FFF;
    background-color: #FFA500; 
    border-radius: 5px;
    transition: all 0.3s;
}

.btn:hover {
    background-color: #FF8C00; 
}

   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">Admin Dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3>Admin</h3>
      <?php if(isset($fetch_profile) && isset($fetch_profile['name'])) { ?>
          <p><?= $fetch_profile['name']; ?></p>
      <?php } else { ?>
          <p>Profile not found</p>
      <?php } ?>
      <a href="update_profile.php" class="btn">Update Profile</a>
   </div>

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $result_orders = $select_orders->get_result(); // Fetch the result set
         $numbers_of_orders = mysqli_num_rows($result_orders); // Count the rows
      ?>
      <h3><?= $numbers_of_orders; ?></h3>
      <p>Total orders</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $result_products = $select_products->get_result(); // Fetch the result set
         $numbers_of_products = mysqli_num_rows($result_products); // Count the rows
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <p>Products added</p>
      <a href="products.php" class="btn">see products</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $result_users = $select_users->get_result(); // Fetch the result set
         $numbers_of_users = mysqli_num_rows($result_users); // Count the rows
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>User accounts</p>
      <a href="users_accounts.php" class="btn">see users</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $result_admins = $select_admins->get_result(); // Fetch the result set
         $numbers_of_admins = mysqli_num_rows($result_admins); // Count the rows
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>Admins</p>
      <a href="admin_accounts.php" class="btn">See Admins </a>
   </div>

   <div class="box">
      <?php
         $stmt = $conn->prepare("SELECT * FROM `reservations`");
         $stmt->execute();
         $result_reservations = $stmt->get_result(); // Fetch the result set
         $numbers_of_reservations = mysqli_num_rows($result_reservations); // Count the rows
      ?>
      <h3><?= $numbers_of_reservations; ?></h3>
      <p>Reservations</p>
      <a href="reservations.php" class="btn">see reservations</a>
   </div>
   </div>

</section>

<!-- admin dashboard section ends -->

</body>

</html>