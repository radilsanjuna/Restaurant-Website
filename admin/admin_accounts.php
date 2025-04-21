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
    $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
    $delete_admin->bind_param("i", $delete_id);
    $delete_admin->execute();
    $delete_admin->close();
    header('location:admin_accounts.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Accounts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="admin_styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ede9e9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .heading {
            color: #d6ccc2; 
            padding: 70px;
            text-align: center;
        }

        .box {
            background-color: #f5ebe0;
            border: 1px solid #d5bdaf;
            border-radius: 10px;
            padding: 20px;
            margin: 10px; 
            max-width: 300px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .box:hover {
            transform: scale(1.02);
        }

        .delete-btn, .option-btn {
            display: inline-block;
            background: #d5bdaf;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px 0;
            transition: background 0.3s;
        }

        .delete-btn:hover, .option-btn:hover {
            background: #c4a69d;
        }

        .flex-btn {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .empty {
            color: #d5bdaf; 
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- Admins accounts section starts  -->

<section class="accounts">

    <h1 class="heading">Admin & Staff Logins</h1>

    <div class="box-container">

        <div class="box">
            <p>Register New Staff</p>
            <a href="register_admin.php" class="option-btn">Register</a>
        </div>

        <?php
            $select_account = $conn->prepare("SELECT * FROM `admin`");
            $select_account->execute();
            $result = $select_account->get_result();
            if ($result->num_rows > 0) {
                while ($fetch_accounts = $result->fetch_assoc()) {
        ?>
        <div class="box">
            <p>Admin ID: <span><?= htmlspecialchars($fetch_accounts['id']); ?></span></p>
            <p>Username: <span><?= htmlspecialchars($fetch_accounts['name']); ?></span></p>
            <div class="flex-btn">
                <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Delete this account?');">Delete</a>
                <?php
                    if ($fetch_accounts['id'] == $admin_id) {
                        echo '<a href="update_profile.php" class="option-btn">Update</a>';
                    }
                ?>
            </div>
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

<!-- Admins accounts section ends -->

</body>
</html>
