<?php

include 'components/conect.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->bind_param("ii", $qty, $cart_id);
    $update_qty->execute();
    $message[] = 'Cart quantity updated!';
}

if (isset($_POST['delete_cart'])) {
    $cart_id = $_POST['cart_id'];
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart->bind_param("i", $cart_id);
    $delete_cart->execute();
    $message[] = 'Cart item deleted!';
}

if (isset($_POST['delete_all'])) {
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->bind_param("i", $user_id);
    $delete_cart->execute();
    $message[] = 'Deleted all from cart!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .heading {
            text-align: center;
            padding: 50px 0;
        }
        .heading h3 {
            font-family: 'Roboto', sans-serif;
            font-size: 3rem;
            color: #F39C12;
        }
        .cart-total {
            margin-top: 30px;
            text-align: center;
        }
        .cart-total .grand-total {
            font-weight: bold;
        }
        .heading{
            padding-top:180px;
            padding-bottom:100px;
        }
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    
    <div class="heading">
        <h3>Shopping Cart</h3>
    </div>

    <section class="container">
        <h1 class="title text-center">Your Cart</h1>
        <div class="row">
        <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->bind_param("i", $user_id);
            $select_cart->execute();
            $result = $select_cart->get_result();
            
            if ($result->num_rows > 0) {
                while ($fetch_cart = $result->fetch_assoc()) {
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="uploaded_img/<?= $fetch_cart['image']; ?>" class="card-img-top" alt="<?= $fetch_cart['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $fetch_cart['name']; ?></h5>
                    <p class="card-text">Price: <span>LKR <?= $fetch_cart['price']; ?></span></p>
                    <form action="" method="POST">
                        <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="number" name="qty" class="form-control" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" style="width: 80px;">
                            <button type="submit" name="update_qty" class="btn btn-warning ml-2">Update</button>
                            <button type="submit" name="delete_cart" class="btn btn-danger ml-2" onclick="return confirm('Delete this item from cart?');">Delete</button>
                        </div>
                    </form>
                    <p class="mt-2">Sub Total: <span>LKR <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span></p>
                </div>
            </div>
        </div>
        <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">Your cart is empty</p>';
            }
        ?>
        </div>
        <div class="cart-total">
            <p class="grand-total"> Total: <span>Rs. <?= $grand_total; ?></span></p>
            <a href="checkout.php" class="btn btn-primary <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to checkout</a>
        </div>        
        <form action="" method="post" class="text-center mt-3">
            <button type="submit" class="btn btn-danger" name="delete_all">Delete All</button>
        </form>
    </section>

    <?php include 'components/footer.php'; ?>     
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
