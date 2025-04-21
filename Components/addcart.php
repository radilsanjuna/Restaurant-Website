<?php

if (isset($_POST['add_to_cart'])) {

    if ($user_id == '') {
        header('location:login.php');
    } else {
        $pid = $_POST['pid'];
        $pid = filter_var($pid);
        $name = $_POST['name'];
        $name = filter_var($name);
        $price = $_POST['price'];
        $price = filter_var($price);    
        $image = $_POST['image'];
        $image = filter_var($image);
        $qty = $_POST['qty'];
        $qty = filter_var($qty);

        // MySQLi query to check if the product is already in the cart
        $check_cart_number = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND name = ?");
        $check_cart_number->bind_param("is", $user_id, $name); // Bind the parameters for MySQLi
        $check_cart_number->execute();
        $result = $check_cart_number->get_result(); // Get the result set

        // Check if any rows exist
        if (mysqli_num_rows($result) > 0) {
            $message[] = 'Already added to cart!';
        } else {
            // Insert into cart if the product is not already added
            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
            $insert_cart->bind_param("iisdis", $user_id, $pid, $name, $price, $qty, $image); // Bind the parameters for MySQLi
            $insert_cart->execute();
            $message[] = 'Added to cart';
        }
    }
}

?>
