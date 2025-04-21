<?php

include '../components/conect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   // Check if product name already exists
   $select_products = mysqli_prepare($conn, "SELECT * FROM `products` WHERE name = ?");
   mysqli_stmt_bind_param($select_products, "s", $name); // 's' for string
   mysqli_stmt_execute($select_products);
   $result = mysqli_stmt_get_result($select_products);

   if(mysqli_num_rows($result) > 0){
      $message[] = 'Product name already exists!';
   } else {
      if($image_size > 2000000){
         $message[] = 'Image size is too large';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);
         $insert_product = mysqli_prepare($conn, "INSERT INTO `products`(name, category, price, image) VALUES(?, ?, ?, ?)");
         mysqli_stmt_bind_param($insert_product, "ssis", $name, $category, $price, $image); // 's' for string, 'i' for integer
         mysqli_stmt_execute($insert_product);
         $message[] = 'New product added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   // Get the product image to delete
   $delete_product_image = mysqli_prepare($conn, "SELECT * FROM `products` WHERE id = ?");
   mysqli_stmt_bind_param($delete_product_image, "i", $delete_id); // 'i' for integer
   mysqli_stmt_execute($delete_product_image);
   $result_delete_image = mysqli_stmt_get_result($delete_product_image);
   $fetch_delete_image = mysqli_fetch_assoc($result_delete_image);
   
   // Delete the product image file
   unlink('../uploaded_img/'.$fetch_delete_image['image']);

   // Delete product from products table
   $delete_product = mysqli_prepare($conn, "DELETE FROM `products` WHERE id = ?");
   mysqli_stmt_bind_param($delete_product, "i", $delete_id);
   mysqli_stmt_execute($delete_product);

   // Delete product from cart if exists
   $delete_cart = mysqli_prepare($conn, "DELETE FROM `cart` WHERE pid = ?");
   mysqli_stmt_bind_param($delete_cart, "i", $delete_id);
   mysqli_stmt_execute($delete_cart);

   header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_styles.css">
   <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #ede9e9; /* Updated background color */
}

header {
    background: #333; 
    color: #fff; 
    text-align: center;
    padding: 20px 0;
}

h1, h3 {
    text-align: center;
    color: #d6ccc2; /* Updated header color */
    margin: 10px 0;
}

form {
    text-align: center;
    padding: 50px;
    background-color: #f5ebe0; /* Light background for form */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input[type="text"],
input[type="number"],
select {
    width: 80%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type="file"] {
    width: 80%;
    margin: 10px 0;
}

input[type="submit"],
a.btn {
    display: inline-block;
    width: 80%;
    padding: 10px;
    text-align: center;
    background: #d5bdaf; /* Updated button background */
    color: #fff; 
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin: 10px 0;
}

.flex-btn {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.box {
    width: 200px;
    padding: 20px;
    background: #f9f9f9; 
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
}

.box img {
    width: 100%; 
    height: auto; 
    border-radius: 5px;
}

.box-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); 
    grid-gap: 20px; 
    justify-content: center;
}

.price {
    font-size: 1.2em;
    font-weight: bold;
    color: #d5bdaf; /* Updated price color */
}

.category {
    margin: 5px 0;
}

.name {
    font-size: 1.1em;
    font-weight: bold;
    margin: 10px 0;
}

.delete-btn {
    background: #FF6347; 
}

form img {
    max-height: 40px; 
    object-fit: cover;
    border: 0.6px solid #FFA500; 
    border-radius: 5px;
}

   </style>
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add Product</h3>
      <input type="text" required placeholder="Enter product name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="Enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>Select category --</option>
         <option value="Fried Rice">Fried Rice</option>
         <option value="Pizza">Pizza</option>
         <option value="Burgers">Burgers</option>
         <option value="Desserts">Desserts</option>
         <option value="Drinks">Drinks</option>
         <option value="Pasta">Pasta</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="Add Product" name="add_product" class="btn">
   </form>

</section>

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
   // MySQLi query to select all products
   $show_products = mysqli_query($conn, "SELECT * FROM `products`");

   // Check if any products exist
   if(mysqli_num_rows($show_products) > 0){
      while($fetch_products = mysqli_fetch_assoc($show_products)){
?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span>LKR </span><?= $fetch_products['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_products['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
      </div>
   </div>
<?php
      }
   } else {
      echo '<p class="empty">No products added yet!</p>';
   }
?>


   </div>

</section>

</body>
</html>