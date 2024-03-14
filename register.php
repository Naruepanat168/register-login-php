<?php
session_start();  // Starting Session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="sign-in.css">
</head>

<body>
    <div class="container">
        <!-- Nav Start -->
        <?php include('nav.php') ?>
        <!--  Nav End -->
    </div>

    <!-- login Start -->
    <main class="form-signin w-100 m-auto">
    <form action="register_db.php" method="POST">
        <h1 class="h3 mb-3 fw-normal">Sign up</h1>

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="form-floating">
            <input type="text" class="form-control my-3" name="username" placeholder="Enter your username">
            <label for="username">Username</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control my-3" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control my-3" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control my-3" name="confirm_password" id="floatingPassword" placeholder="Confirm Password">
            <label for="floatingPassword">Confirm Password</label>
        </div>
        <button class="btn btn-primary w-100 py-2" name="register" type="submit">Sign up</button>
        <p class="mt-5 mb-3 text-body-secondary">Already have an account? <a href="login.php">Click here</a> to sign in</p>
    </form>
</main>

    <!-- login End -->

    <div class="container">
        <!-- Footer Start -->
        <?php include('footer.php') ?>
        <!-- Footer End -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>