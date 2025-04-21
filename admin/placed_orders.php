<?php

include '../components/conect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_status->execute([$payment_status, $order_id]);
    $message[] = 'Payment status updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="admin_styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ede9e9; /* Updated background color */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .placed-orders {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 100px;
        }

        .heading {
            color: #d6ccc2; /* Heading color */
        }

        .box-container {
            background-color: #f5ebe0; /* Box container background */
            border: 1px solid #d5bdaf; /* Border color */
            padding: 20px;
            margin: 0;
            max-width: 600px;
            align-items: center;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .box {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #d5bdaf; /* Box border color */
            border-radius: 8px; /* Rounded corners */
            background-color: #fff; /* Box background color */
            transition: transform 0.2s;
        }

        .box:hover {
            transform: scale(1.02); /* Hover effect */
        }

        .box p {
            margin: 5px 0;
        }

        .box span {
            font-weight: bold;
            color: #d5bdaf; /* Span color */
        }

        .empty {
            color: #d5bdaf; /* Empty message color */
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- Placed orders section starts  -->

<section class="placed-orders">

    <h1 class="heading">Placed Orders</h1>

    <div class="box-container">
    <?php
$select_orders = $conn->prepare("SELECT * FROM `orders`");
$select_orders->execute();
$result = $select_orders->get_result();

if ($result->num_rows > 0) {
    while ($fetch_orders = $result->fetch_assoc()) {
?>
    <div class="box">
        <p>User ID: <span><?= htmlspecialchars($fetch_orders['user_id']); ?></span></p>
        <p>Name: <span><?= htmlspecialchars($fetch_orders['name']); ?></span></p>
        <p>Number: <span><?= htmlspecialchars($fetch_orders['number']); ?></span></p>
        <p>Total Products: <span><?= htmlspecialchars($fetch_orders['total_products']); ?></span></p>
        <p>Total Price: <span>LKR <?= htmlspecialchars($fetch_orders['total_price']); ?>/-</span></p>
        <p>Payment Method: <span><?= htmlspecialchars($fetch_orders['method']); ?></span></p>
    </div>
<?php
    }
} else {
    echo '<p class="empty">No orders placed yet!</p>';
}
$select_orders->close();
?>

    </div>
</section>

<!-- Placed orders section ends -->

</body>
</html>