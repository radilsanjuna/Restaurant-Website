<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS styles */
        body {
            margin: 0;
            padding: 0;
        }

        .header {
            width: 100%;
            background: #6b9080; /* Darker color */
            color: #FFF; 
            padding: 0.25rem 1rem;
            position: fixed;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0.5; 
            
        }

        .logo {
            color: #FFF; 
            text-decoration: none;
        }

        .logo:hover {
            background: #a4c3b2; /* Second color */
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .flex {
            display: flex;
            align-items: center;
            width: 100%; /* Ensure full width for flexbox */
        }

        .navbar a {
            color: #cce3de; /* Third color */
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            position: relative;
        }

        .navbar a:hover {
            background: #a4c3b2; /* Second color */
        }

        .profile {
            display: flex;
            align-items: center;
            margin-left: auto; /* Push profile section to the right */
        }

        .btn {
            color: #FFF; /* White color for the button */
            background: #a4c3b2; /* Second color */
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            margin-left: 1rem; /* Space between profile text and button */
        }

        .btn:hover {
            background: #cce3de; /* Third color on hover */
        }

        /* Style for .flex-btn, .option-btn, .delete-btn */
        .option-btn, .delete-btn {
            color: #cce3de; /* Third color */
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            position: relative;
            display: flex;
            align-items: center;
        }

        .flex-btn {
            display: flex;
            align-items: center;
        }

        .option-btn-reg {
            color: #cce3de; /* Third color */
            text-decoration: none;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            position: relative;
            display: flex;
            align-items: center;
        }

        .option-btn:hover, .delete-btn:hover {
            background: #a4c3b2; /* Second color */
        }

        .option-btn-reg:hover {
            background: #a4c3b2; /* Second color */
        }

    </style>
</head>
<body>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
            <div class="message">
                <span>' . $msg . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    ?>

    <header class="header">
        <section class="flex">
            <a href="dashboard.php" class="logo">Gallery Cafe</a>
            <nav class="navbar">
                <a href="products.php">Products</a>
                <a href="reservations.php">Reservations</a>
                <a href="admin_accounts.php">Admins</a>
                <a href="users_accounts.php">Users</a>
                <a href="placed_orders.php">Orders</a>
            </nav>
            <div class="profile">
                <?php
                if (isset($_SESSION['admin_id'])) {
                    $admin_id = $_SESSION['admin_id'];

                    $stmt = mysqli_prepare($conn, "SELECT * FROM `admin` WHERE id = ?");
                    mysqli_stmt_bind_param($stmt, "i", $admin_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($fetch_profile = mysqli_fetch_assoc($result)) {
                        echo '<p>' . htmlspecialchars($fetch_profile['name']) . '</p>';
                    }

                    mysqli_stmt_close($stmt);
                }
                ?>
                <div class="flex-btn">
                    <a href="admin_login.php" class="option-btn">Login</a>
                    <a href="register_admin.php" class="option-btn-reg">Register</a>
                    <a href="update_profile.php" class="btn">Update Profile</a>
                </div>
                <a href="../admin/admin_login.php" onclick="return confirm('Logout from this website?');" class="delete-btn">Logout</a>
            </div>
        </section>
    </header>
</body>

</html>