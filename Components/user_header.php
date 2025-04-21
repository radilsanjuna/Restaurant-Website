<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Signature Cuisine</title>
    <style>
        /* CSS styles here */
        .header {
            width: 100%;
            background: black; /* dark blue */
            opacity: 0.8; /* 50% transparent */
            position: fixed;
            padding: 0.7rem; /* Reduced size */
            z-index: 1000;
            border-radius: 0 0 15px 15px; /* Rounded corners */
            
        }

        .header .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            display: block;
            object-fit: cover;
            width: 10%;
        }

        .navbar {
            display: flex;
            align-items: center;
            margin-right: auto;
        }

        .navbar li {
            list-style-type: none;
            margin: 0 1rem; /* Adjusted spacing */
            margin-right:10px;
        }

        .navbar li a {
            text-decoration: none;
            color: white;
            font-size: 1.6rem; /* Slightly smaller font */
            position: relative;
        }

        .navbar li a::after {
            content: "";
            position: absolute;
            height: 3px;
            background: var(--primary_color);
            width: 0%;
            left: 0;
            bottom: -10px;
            transition: all 0.15s ease-in;
        }

        .navbar li a:hover::after {
            width: 100%;
        }

        .icons {
            display: flex;
            align-items: center;
            margin-left: auto;
            margin-right:5px;
        }

        .icons a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-size: 1.6rem; /* Resized icons */
        }

        .icons a:last-child {
            margin-right: 0;
        }

        .profile {
            color: white;
        }

        .profile .name {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .profile .btn,
        .profile .delete-btn {
            padding: 10px 20px; /* Increased padding */
            border-radius: 5px; /* Rounded corners */
            text-decoration: none;
            color: white;
            
        }

        .profile .btn {
            background: var(--primary_color);
            margin-right:5px;
        }

        .profile .delete-btn {
            background: red;
        }
    </style>
</head>
<body>
<?php
if(isset($message)){
    foreach($message as $msg) {
        echo '
        <div class="message">
        <span>'.$msg.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
        ';
    }  
}
?>

<header class="header">
    <section class="flex">
        <a href="index.php" class="logo"><img src="uploaded_img/logo.png" alt="Signature Cuisine"></a>
        <nav class="navbar">
            <li><a href="./index.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="./facilities.php">Facilities</a></li>
            <li><a href="./reservations.php">Reservations</a></li>
            <li><a href="./cart.php">Cart</a></li>
        </nav>

        <div class="icons">
            <?php
              $count_user_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$count_user_cart_items->bind_param("i", $user_id);
$count_user_cart_items->execute();
$result = $count_user_cart_items->get_result();
$total_user_cart_items = $result->num_rows;  // ✅ Correct way

            ?>
           <a href="search.php"><i class="fas fa-search"></i></a>
           <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?=$total_user_cart_items; ?>)</span></a>
        </div>

        <div class="profile">
        <?php
       $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
       $select_profile->bind_param("i", $user_id);
       $select_profile->execute();
       
          $result = $select_profile->get_result();
          if ($result->num_rows > 0) {  // ✅ Correct way
              $fetch_profile = $result->fetch_assoc();
          
        ?>
        <p class="name"><?= $fetch_profile['name']; ?></p>
        <div class="flex">
            <a href="profile.php" class="btn">Profile</a>
            <a href="login.php" onclick="return confirm('logout from this website?');" class="delete-btn">Logout</a>
        </div>
        
        <?php
        } else {
        ?>
            <p class="name">Please login first</p>
            <a href="login.php" class="btn">Login</a>
        <?php
        }
        ?>
        </div>

    </section>

</header>
</body>
</html>