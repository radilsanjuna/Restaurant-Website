<?php

include '../components/conect.php'; // Make sure this uses mysqli

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit;
}

if (isset($_POST['update'])) {

   $pid = mysqli_real_escape_string($conn, $_POST['pid']);
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $category = mysqli_real_escape_string($conn, $_POST['category']);

   // Update product info (name, category, price)
   $update_query = "UPDATE `products` SET name = '$name', category = '$category', price = '$price' WHERE id = '$pid'";
   mysqli_query($conn, $update_query);

   $message[] = 'Product updated!';

   $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = '../uploaded_img/' . $image;

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $message[] = 'Image size is too large!';
      } else {
         // Update image column
         $update_img_query = "UPDATE `products` SET image = '$image' WHERE id = '$pid'";
         mysqli_query($conn, $update_img_query);

         move_uploaded_file($image_tmp_name, $image_folder);

         // Check if old image exists before deleting
         $old_image_path = '../uploaded_img/' . $old_image;
         if (file_exists($old_image_path)) {
            unlink($old_image_path);
         } else {
            // Log or silently ignore if file not found
            // echo "Old image not found: $old_image_path";
         }

         $message[] = 'Image updated!';
      }
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="admin_styles.css">
   <style>
      /* CSS code */
body {
    font-family: 'Arial', sans-serif;
    background-color: #fefae0; /* Moccasin */
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.heading {
    color: #FF8C00; 
}

.box {
    background-color: #FFF8DC;
    border: 1px solid #FFA500; 
    padding: 10px;
    margin: 10px;
    max-width: 300px;
}

form input[type="text"],
form input[type="number"],
form select {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #FFA500; 
    border-radius: 4px;
}

form input[type="submit"],
.option-btn {
    background-color: #FFA500; 
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 5px;
}
form img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 10px auto;
    max-height: 150px;
    object-fit: cover;
    border: 1px solid #FFA500; 
    border-radius: 5px;
}

form input[type="submit"]:hover,
.option-btn:hover {
    background-color: #FFD700; 
}

.flex-btn {
    display: flex;
    justify-content: space-between;
}

.empty {
    color: #FF8C00;
    margin-top: 20px;
}
   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section starts  -->

<section class="update-product">

   <h1 class="heading">update product</h1>

   <?php
$update_id = $_GET['update'];

// Prepare and execute the statement
$show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
$show_products->bind_param("i", $update_id);
$show_products->execute();
$result = $show_products->get_result();

if ($result->num_rows > 0) {
    while ($fetch_products = $result->fetch_assoc()) {
?>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_products['id']); ?>">
    <input type="hidden" name="old_image" value="<?= htmlspecialchars($fetch_products['image']); ?>">
    <img src="../uploaded_img/<?= htmlspecialchars($fetch_products['image']); ?>" alt="">
    
    <span>update name</span>
    <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="<?= htmlspecialchars($fetch_products['name']); ?>">

    <span>update price</span>
    <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= htmlspecialchars($fetch_products['price']); ?>">

    <span>update category</span>
    <select name="category" class="box" required>
        <option selected value="<?= htmlspecialchars($fetch_products['category']); ?>"><?= htmlspecialchars($fetch_products['category']); ?></option>
        <option value="main dish">main dish</option>
        <option value="fast food">fast food</option>
        <option value="drinks">drinks</option>
        <option value="desserts">desserts</option>
    </select>

    <span>update image</span>
    <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">

    <div class="flex-btn">
        <input type="submit" value="update" class="btn" name="update">
        <a href="products.php" class="option-btn">go back</a>
    </div>
</form>
<?php
    }
} else {
    echo '<p class="empty">no products added yet!</p>';
}

$show_products->close();
?>


</section>

<!-- update product section ends -->












</body>
</html>