<?php
include 'Components/conect.php';

if (isset($_POST['submit'])) {
    // Sanitize user input to prevent SQL injection
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $number = trim($_POST['number']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate required fields
    if (empty($name) || empty($email) || empty($number) || empty($password) || empty($cpassword)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif ($password !== $cpassword) {
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $check_email = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already exists!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert data into database
            $sql = "INSERT INTO users (name, email, number, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $number, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Registration successful! Click OK to login.');
                    window.location.href = 'login.php';
                </script>";
                exit();
            } else {
                $error = 'Error: ' . $conn->error;
            }
            
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('images/login-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #333;
        }

        .form-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 12px;
            font-size: 14px;
        }

        .form-container button {
            background: #d32f2f;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .form-container button:hover {
            background-color: #b71c1c;
        }

        .message {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        .error {
            background: #dc3545;
            color: white;
        }

        .success {
            background: #28a745;
            color: white;
        }

        .form-container p a {
            color: #d32f2f;
            font-weight: 500;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>User Registration</h2>

        <!-- Display success/error message -->
        <?php if (isset($error)) { echo "<div class='message error'>$error</div>"; } ?>
        <?php if (isset($success)) { echo "<div class='message success'>$success</div>"; } ?>

        <form action="" method="POST">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="text" name="number" placeholder="Enter Phone Number" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" required>
            <button type="submit" name="submit">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="login.php">Login Here</a></p>
    </div>

</body>
</html>
