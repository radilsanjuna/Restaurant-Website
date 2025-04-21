<?php

include 'components/conect.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$message = []; // Initialize the message array

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email
    $pass = $_POST['pass']; // Password does not need FILTER_SANITIZE

    // Prepare statement to prevent SQL injection
    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $select_user->bind_param("s", $email);
    $select_user->execute();
    $result = $select_user->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($pass, $row['password'])) {  
        $_SESSION['user_id'] = $row['id'];
        header('location:index.php');  
        exit(); // Exit after header redirection
    } else {
        $message[] = 'Incorrect email or password!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

.form-container h3 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
    color: #333;
}

.form-container .form-control {
    border-radius: 12px;
}

.form-container .btn-primary {
    background-color: #d32f2f;
    border: none;
    border-radius: 12px;
    padding: 10px;
    font-weight: bold;
}

.form-container .btn-primary:hover {
    background-color: #b71c1c;
}

.form-container p a {
    color: #d32f2f;
    font-weight: 500;
}

.alert-danger {
    border-radius: 10px;
}

    </style>
</head>
<body>
    
    <!-- Login Section -->
    <main>
    <div class="form-container">
        <form action="" method="POST">
            <h3>Login to Gallery Café</h3>
            <?php if (!empty($message)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($message as $msg): ?>
                        <p><?php echo $msg; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <input type="email" name="email" required placeholder="Enter your email" maxlength="100" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="pass" required placeholder="Enter your password" maxlength="10" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-center mt-3">Don't have an account? <a href="register.php">Register Now</a></p>
        </form>
    </div>
</main>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
