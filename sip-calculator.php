<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login System | Welcome <?php echo $_SESSION['username'] ?> </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <header class="application-header">
        <a class="logo" href="/login-system/signup.php">
            <img src="images/logo.png" alt="Company Logo" class="img-fluid nav-logo" />
        </a>
        <div class="logout-div">
            <ul>
                <li class="align-self-center " style="margin: 0% 1rem;">
                    <div class="link sip-calculator">
                        <a class="text-dark" style="text-decoration: none;" href="/login-system/welcome.php">Home</a>
                    </div>
                </li>
                <li class="d-flex flex-column" style="margin: 0% 1rem;">
                    <div class="username-logout">
                        Hi&#128075
                        <code style="background-color: grey; border-radius: .3rem; padding: .2rem .3rem; color: white;">
                            <?php echo $_SESSION['username'] ?>
                        </code>
                    </div>
                    <div class="link logout">
                        <a href="/login-system/logout.php" style="text-decoration: none;">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bg-white">
                        <h1>SIP Calculator</h1>
                    </div>
                    <div class="card-body">
                        <form id="sipForm" method="post" action="">
                            <div class="form-group">
                                <label for="amount">Monthly Investment (₹):</label>
                                <input type="number" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="form-group">
                                <label for="rate">Expected Return Rate (%):</label>
                                <input type="number" step="0.01" class="form-control" id="rate" name="rate" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">Time Period (years):</label>
                                <input type="number" class="form-control" id="duration" name="duration" required>
                            </div>
                            <button type="submit" name="calculate" class="btn btn-outline-dark btn-block">Calculate</button>
                        </form>
                    </div>
                    <div id="resultSection" class="card-footer text-center">
                        <?php
                        if (isset($_POST['calculate'])) {
                            $amount = $_POST['amount'];
                            $rate = $_POST['rate'];
                            $duration = $_POST['duration'];

                            $monthly_rate = ($rate / 100) / 12;
                            $total_months = $duration * 12;

                            $future_value = $amount * (((pow(1 + $monthly_rate, $total_months) - 1) / $monthly_rate) * (1 + $monthly_rate));
                            $invested_amount = $amount * $total_months;
                            $returns = $future_value - $invested_amount;

                            echo "<h3>Future Value of SIP: ₹" . number_format($future_value, 2) . "</h3>";
                            echo "<p>Total Investment Amount: <b>₹" . number_format($invested_amount, 2) . "</b> Total Returns Amount: <b>₹" . number_format($returns, 2) . "</b></p>";
                            echo "<input type='hidden' id='investedAmount' value='" . $invested_amount . "'>";
                            echo "<input type='hidden' id='returns' value='" . $returns . "'>";
                        }
                        ?>
                    </div>
                    <div id="chartSection" class="card-footer text-center">
                        <canvas id='myChart'></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/sip-calculator.js"></script>
</body>

</html>