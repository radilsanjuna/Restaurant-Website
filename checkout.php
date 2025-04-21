<?php
include 'components/conect.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $total_products = mysqli_real_escape_string($conn, $_POST['total_products']);
    $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['address']); // new

    $check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");

    if (mysqli_num_rows($check_cart) > 0) {
        $insert_order = "INSERT INTO `orders` 
        (user_id, name, number, email, method, total_products, total_price, address) 
        VALUES ('$user_id', '$name', '$number', '$email', '$method', '$total_products', '$total_price', '$address')";
        mysqli_query($conn, $insert_order);

        $delete_cart = "DELETE FROM `cart` WHERE user_id = '$user_id'";
        mysqli_query($conn, $delete_cart);

        $message[] = 'Order placed successfully!';
    } else {
        $message[] = 'Your cart is empty!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .checkout {
            text-align: center;
            max-width: 600px;
            margin: auto;
            padding-top: 50px;
        }
        .title {
            font-size: 3.5rem;
            color: #F39C12;
        }
        .cart-items h3, .user-info h3 {
            font-size: 2.5rem;
        }
        .grand-total {
            font-size: 1.5rem;
        }
        footer {
            text-align: center;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }
    </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="checkout">
    <h1 class="title">Order Summary</h1>
    <form action="" method="post">

    <div class="cart-items mb-4">
        <h3>Cart Items</h3>
        <?php
        $grand_total = 0;
        $cart_items = [];
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '.$fetch_cart['quantity'].')';
                $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
            ?>
            <p><span class="name"><?= $fetch_cart['name']; ?></span> <span class="price">LKR <?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
            <?php
            }
            $total_products = implode(', ', $cart_items);
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }
        ?>
        <p class="grand-total"><strong>Grand total:</strong> <span>LKR <?= $grand_total;?></span></p>
        <a href="cart.php" class="btn btn-secondary">View cart</a>
    </div>

    <!-- Hidden values for form submission -->
    <input type="hidden" name="total_products" value="<?= $total_products ?? ''; ?>">
    <input type="hidden" name="total_price" value="<?= $grand_total; ?>">

    <!-- User Info Form -->
    <div class="user-info">
        <h3>Your Information</h3>
        <div class="form-group">
            <input type="text" name="name" placeholder="Your name" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Your email" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="tel" name="number" placeholder="Your phone number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="method">Select payment method</label>
            <select name="method" class="form-control" required>
                <option value="" disabled selected>Select payment method</option>
                <option value="cash on delivery">Cash on delivery</option>
                <option value="Credit card">Credit card</option>
                <option value="Master card">Master card</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Delivery Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter your delivery address here..." required></textarea>
        </div>
        <input type="submit" value="Place Order" class="btn btn-primary" name="submit">
    </div>
       
    </form>
</section>

<?php include 'components/footer.php'; ?>     

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
