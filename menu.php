<?php

include 'components/conect.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

include 'components/addcart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
    <style>
        .products {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            grid-gap: 30px; 
            justify-content: center;
        }

        .title {
            color:#333; 
            font-size: 2.5rem;
            margin-bottom: 25px;
            padding-top:120px;
        }

        .box {
            border: 1px solid #1b263b;
            padding: 50px;
            text-align: center;
            position: relative;
            border-radius: 20px;
        }

        .image {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            object-fit: cover;
            height: 250px;
        }

        .name {
            color:#333;
            font-size: 1.8rem;        
        }

        .price {
            color:#255;
            font-size: 1.8rem;  
        }

        .qty {
            border-radius: 4px;
            border-color: aquamarine;
        }
    </style>
</head>
<body>
    
    <!--header start-->
    <?php include 'components/user_header.php'; ?>
    <!--header end-->

    <!--menu start-->
    <section class="products">
        <h1 class="title">Menu</h1>
        <div class="box-container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
                <form action="" method="POST" class="box">
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                    <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>
                    <img src="uploaded_img/<?= $fetch_products['image']; ?>" class="image" alt="">
                    <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                    <div class="name"><?= $fetch_products['name']; ?></div>
                    <div class="flex">
                        <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length ==2) return false">
                    </div>
                </form>
            <?php
                }
            } else {
                echo '<div class="empty">No products added yet</div>';
            }
            ?>
        </div>
    </section>
    
    <?php include 'components/footer.php'; ?>
    
    <script src="JS/Script.js"></script>
</body>
</html>
