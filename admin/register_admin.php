<?php

include '../components/conect.php';

session_start();

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name']);
    $pass = sha1($_POST['pass']);
    $cpass = sha1($_POST['cpass']);

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
    $select_admin->execute([$name]);

    if ($select_admin->rowCount() > 0) {
        $message[] = 'Username already exists!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Confirm password not matched!';
        } else {
            $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?, ?)");
            $insert_admin->execute([$name, $cpass]);
            $message[] = 'New admin registered!';
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
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #FDF5E6; /* Same background as login page */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #FFF8DC; 
            border: 1px solid #FFA500; 
            padding: 40px;
            border-radius: 5px;
            width: 100%;
            max-width: 400px;
        }
        .form-container h3 {
            color: #FF8C00; 
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">
    <?php
    if (!empty($message)) {
        foreach ($message as $msg) {
            echo '<div class="alert alert-warning">' . $msg . '</div>';
        }
    }
    ?>
    <form action="" method="POST">
        <h3>Register</h3>
        <div class="form-group">
            <input type="text" name="name" maxlength="20" required placeholder="Enter your username" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>
        <div class="form-group">
            <input type="password" name="pass" maxlength="20" required placeholder="Enter your password" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>
        <div class="form-group">
            <input type="password" name="cpass" maxlength="20" required placeholder="Confirm your password" class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>
        <button type="submit" name="submit" class="btn btn-warning btn-block">Register Now</button>
    </form>
</section>

</body>
</html>