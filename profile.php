<?php
include 'components/conect.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

// Fetch user profile
$fetch_profile = [];
if ($user_id) {
    $select_profile = $conn->prepare("SELECT name, email, number FROM users WHERE id = ?");
    $select_profile->bind_param("s", $user_id);
    $select_profile->execute();
    $result = $select_profile->get_result();
    if ($result && $result->num_rows > 0) {
        $fetch_profile = $result->fetch_assoc();
    }
}
?>

<?php include 'components/user_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .user-profile .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50%;
        }
        .user-profile .card-title {
            font-size: 1.5rem;
            margin: 1rem 0;
        }
    </style>
</head>
<body>

    <!-- Profile start -->
    <section class="user-profile py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="images/person.png" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                            
                            <h5 class="card-title">
                                <i class="fas fa-user"></i>
                                <span><?= isset($fetch_profile['name']) ? $fetch_profile['name'] : 'Unknown'; ?></span>
                            </h5>

                            <p class="card-text">
                                <i class="fas fa-envelope"></i>
                                <span><?= isset($fetch_profile['email']) ? $fetch_profile['email'] : 'Unknown'; ?></span>
                            </p>

                            <p class="card-text">
                                <i class="fas fa-phone"></i>
                                <span><?= isset($fetch_profile['number']) ? $fetch_profile['number'] : 'Unknown'; ?></span>
                            </p>

                            <a href="update_profile.php" class="btn btn-primary mb-2">Update Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile end -->

    <?php include 'components/footer.php'; ?> 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="JS/Script.js"></script>
</body>
</html>
