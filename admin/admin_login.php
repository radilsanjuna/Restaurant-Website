<?php

session_start();
$message = ""; 

// Hardcoded credentials
$correct_name = "admin";
$correct_password = sha1("123456"); // You can change this password if needed

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $pass_input = trim($_POST['pass']);
    $pass_hashed = sha1($pass_input);

    if ($name === $correct_name && $pass_hashed === $correct_password) {
        $_SESSION['admin_id'] = 1; // You can use any static ID or session flag
        header('Location: dashboard.php');
        exit;
    } else {
        $message = 'Incorrect username or password!';
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #FDF5E6; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message {
            background-color: #FFDAB9; 
            color: #8B4513; 
            border: 1px solid #FF8C00; 
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (!empty($message)) {
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>';
        }
        ?>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="" method="POST" class="border p-4 bg-light">
                    <h3 class="text-center">Login Now</h3>
                    <p class="text-center">Please Login</p>
                    <div class="form-group">
                        <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" maxlength="20" required placeholder="Enter your password" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-warning btn-block">Login Now</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>