<?php
$showSuccessAlert = false;
$showUnsuccessAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "partials/_dbconnect.php";
    $username = $_POST["login-floatingUsername"];
    $password = $_POST["login-floatingPassword"];
    $sql = "SELECT * from users where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: welcome.php");
            exit;
        } else {
            $showUnsuccessAlert = true;
        }
    } else {
        $showUnsuccessAlert = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login System | Log In</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php require 'partials/_alerts.php' ?>

    <section class="login-form">
        <div class="auth-card">
            <div class="card-body">
                <h5 class="card-title text-center">Log In</h5>
                <form action="/login-system/login.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="login-floatingUsername" placeholder="username" name="login-floatingUsername" require />
                        <label for="login-floating">username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="login-floatingPassword" placeholder="Password" name="login-floatingPassword" require />
                        <label for="login-floatingPassword">Password</label>
                    </div>

                    <button type="submit" class="btn btn-outline-dark log-in-submit-btn mb-3">
                        Log In
                    </button>
                    <div class="alert text-center" role="alert">
                        *Haven't signed-up yet? Don't worry,
                        <a href="/login-system/signup.php" style="text-decoration: none;">Sign Up</a> !
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>