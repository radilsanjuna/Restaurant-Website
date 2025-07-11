<?php

include '../components/conect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name);

    if (!empty($name)) {
        $select_name = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
        $select_name->execute([$name]);
        if ($select_name->rowCount() > 0) {
            $message[] = 'Username already taken!';
        } else {
            $update_name = $conn->prepare("UPDATE `admin` SET name = ? WHERE id = ?");
            $update_name->execute([$name, $admin_id]);
        }
    }

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_old_pass = $conn->prepare("SELECT password FROM `admin` WHERE id = ?");
    $select_old_pass->execute([$admin_id]);
    $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass);
    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass);

    if ($old_pass != $empty_pass) {
        if ($old_pass != $prev_pass) {
            $message[] = 'Old password not matched!';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'Confirm password not matched!';
        } else {
            if ($new_pass != $empty_pass) {
                $update_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
                $update_pass->execute([$confirm_pass, $admin_id]);
                $message[] = 'Password updated successfully!';
            } else {
                $message[] = 'Please enter a new password!';
            }
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
    <title>Profile Update</title>
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

        .form-container h3 {
            color: #d6ccc2; /* Heading color */
            align-items: center;
        }

        .form-container {
            background-color: #f5ebe0; /* Box container background */
            border: 1px solid #d5bdaf; /* Border color */
            padding: 50px;
            margin: 100px;
            max-width: 400px;
            align-items: center;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #d5bdaf; /* Input border color */
            border-radius: 8px; /* Rounded corners */
            background-color: #fff; /* Input background */
            transition: border-color 0.3s;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="password"]:focus {
            border-color: #ffa500; /* Focus border color */
        }

        .form-container input[type="submit"] {
            background-color: #ffa500; /* Button background */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px; /* Rounded corners */
            cursor: pointer;
            margin: 10px 0;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #ffd700; /* Button hover background */
        }

        .form-container .empty {
            color: #d5bdaf; /* Empty message color */
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- Admin profile update section starts  -->

<section class="form-container">

    <form action="" method="POST">
        <h3>Update Profile</h3>
        <input type="text" name="name" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="<?= htmlspecialchars($fetch_profile['name']); ?>">
        <input type="password" name="old_pass" maxlength="20" placeholder="Enter your old password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="new_pass" maxlength="20" placeholder="Enter your new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="confirm_pass" maxlength="20" placeholder="Confirm your new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="Update Now" name="submit" class="btn">
    </form>

</section>

<!-- Admin profile update section ends -->

</body>
</html>