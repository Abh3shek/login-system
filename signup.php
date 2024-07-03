<?php
$showSuccessAlert = false;
$showUnsuccessAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "partials/_dbconnect.php";
    $username = $_POST["signup-floatingName"];
    $email = $_POST["signup-floatingEmail"];
    $password = $_POST["signup-floatingPassword"];
    $cPassword = $_POST["signup-floatingConfirmPassword"];
    $checkUsername = "SELECT * FROM `users` WHERE username = '$username'";
    $checkEmail = "SELECT * FROM `users` WHERE email = '$email'";
    $checkUsernameResult = mysqli_query($conn, $checkUsername);
    $checkEmailResult = mysqli_query($conn, $checkEmail);
    $usernameExistRows = mysqli_num_rows($checkUsernameResult);
    $emailExistRows = mysqli_num_rows($checkEmailResult);

    if ($usernameExistRows > 0) {
        echo '<div class="alert alert-warning alert-dismissible fade show showAlert mt-3" role="alert">
                <strong>Username already exists!</strong> Kindly try different username.
                the same credentials
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
                </div>';
    } else if ($emailExistRows > 0) {
        echo '<div class="alert alert-warning alert-dismissible fade show showAlert mt-3" role="alert">
                <strong>Email exists!</strong> The email is already registered with us try using different email.
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
                </div>';
    } else {
        $exists = false;
        if ((strlen($username) > 4) && (strlen($password) > 8) && (str_contains($email, '@')) && ($password == $cPassword)) {
            $encrypt_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `email`, `password`, `dt`) VALUES ('$username', '$email', '$encrypt_password', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showSuccessAlert = true;
            }
        } else {
            $showUnsuccessAlert = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login System | Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php require 'partials/_alerts.php' ?>

    <section class="signup-form">
        <div class="card px-0 py-2">
            <div class="card-body">
                <h5 class="card-title text-center">Sign Up</h5>
                <form action="/login-system/signup.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="signup-floatingName" placeholder="Name" name="signup-floatingName" />
                        <label for="signup-floatingEmail">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="signup-floatingEmail" placeholder="Email address" name="signup-floatingEmail" />
                        <label for="signup-floatingEmail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="signup-floatingPassword" placeholder="Password" name="signup-floatingPassword" />
                        <label for="signup-floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="signup-floatingConfirmPassword" placeholder="Confirm Password" name="signup-floatingConfirmPassword" />
                        <label for="signup-floatingConfirmPassword">Confirm Password</label>
                    </div>

                    <button type="submit" class="btn btn-outline-dark sign-up-submit-btn mb-3">
                        Sign Up
                    </button>
                    <div class="alert text-center" role="alert">
                        *Already signed-up? Let's
                        <a href="/login-system/login.php" style="text-decoration: none;">Log In</a> !
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap js -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>