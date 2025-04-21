<?php

include '../components/conect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit;
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_users->bind_param("i", $delete_id);
    $delete_users->execute();
    $delete_users->close();

    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_order->bind_param("i", $delete_id);
    $delete_order->execute();
    $delete_order->close();

    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->bind_param("i", $delete_id);
    $delete_cart->execute();
    $delete_cart->close();

    header('location:users_accounts.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Accounts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .heading {
            color: #d2691e;
            padding: 50px;
            text-align: center;
        }

        .box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .box {
            background-color: #fff;
            border: 1px solid #d2691e;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            max-width: 300px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .box:hover {
            transform: scale(1.05);
        }

        .delete-btn {
            background: #ff4500;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .delete-btn:hover {
            background: #ff6347;
        }

        .empty {
            color: #d2691e;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">
    <h1 class="heading">User Accounts</h1>

    <div class="box-container">

        <?php
        $select_account = $conn->prepare("SELECT * FROM `users`");
        $select_account->execute();
        $result = $select_account->get_result();

        if ($result->num_rows > 0) {
            while ($fetch_accounts = $result->fetch_assoc()) {
        ?>
                <div class="box">
                    <p>User ID: <span><?= htmlspecialchars($fetch_accounts['id']); ?></span></p>
                    <p>Username: <span><?= htmlspecialchars($fetch_accounts['name']); ?></span></p>
                    <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
                </div>
        <?php
            }
        } else {
            echo '<p class="empty">No accounts available</p>';
        }

        $select_account->close();
        ?>

    </div>

</section>

</body>
</html>
