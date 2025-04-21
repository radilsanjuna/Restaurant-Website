<?php
include 'components/conect.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

include 'components/addcart.php';
include 'components/user_header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file links -->
   <link rel="stylesheet" href="search.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Search Form Section -->
<section class="search-form">
   <form method="post" action="">
      <input type="text" name="search_box" placeholder="Search here..." class="box">
      <button type="submit" name="search_btn" class="fas fa-search"></button>
   </form>
</section>

<!-- Products Section -->
<section class="products" style="min-height: 100vh; padding-top:0;">
   <div class="box-container">

   <?php
   if (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
      $search_box = $_POST['search_box'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE CONCAT('%', ?, '%')");
      $select_products->bind_param("s", $search_box);
      $select_products->execute();
      $result = $select_products->get_result();

      if ($result && $result->num_rows > 0) {
         while ($fetch_products = $result->fetch_assoc()) {
   ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
   <?php
         }
      } else {
         echo '<p class="empty">No products found!</p>';
      }
   }
   ?>

   </div>
</section>

<!-- custom js file -->
<script src="js/script.js"></script>
</body>
</html>
