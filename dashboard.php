<?php
session_start();  // Starting Session
require "config.php";

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Kakai</title>
</head>

<body>

    <div class="container">
        <!-- Nav start -->
        <?php include('nav.php') ?>
        <!-- Nav End -->
        <!-- Hero Start -->
        <div class="px-4 py-5 my-5 text-center">
            <?php
            // Ensure user_id is set before using it
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            } else {
                // Handle case where user_id is not set (shouldn't happen)
                echo "Error: User ID not available.";
            }

            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->execute([$user_id]);
                $userData = $stmt->fetch();
            } catch (PDOException $e) {
                echo "Error : " . $e->getMessage();
            }
            ?>

            <h1 class="display-5 fw-bold text-body-emphasis">Welcome, <?php echo $userData['username'] ?></h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Email: <?php echo $userData['email'] ?></p>
            </div>
        </div>
        <!-- Hero End -->
        <?php include('footer.php') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>