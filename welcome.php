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
            <a class="text-dark" style="text-decoration: none;" href="/login-system/sip-calculator.php">Sip Calculator</a>
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

  <div class="container">
    <div class="row rw">
      <div class="col-sm-4 mb-3 mb-sm-0 search-txt">
        <h3>Search</h3>
      </div>
      <div class="col-sm-12 mb-3 mb-sm-0">
        <form class="search-div" id="search-div">
          <div class="mt-4">
            <input type="text" class="form-control" id="coin-symbol" name="coin-symbol" aria-describedby="emailHelp" placeholder="Enter crypto here..." required />
            <div id="coin-search-help" class="form-text">
              Explore cryptocoins like BTC, ETH, DOGE and lot more...
            </div>
          </div>

          <button type="submit" class="btn btn-outline-dark search-res-btn">
            Submit
          </button>
        </form>
      </div>
      <div class="col-10 result-block">
        <div class="row res-row" id="res-row"></div>
      </div>

      <!-- Modal Structure -->
      <div class="modal fade" id="cryptoModal" tabindex="-1" aria-labelledby="cryptoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cryptoModalLabel">Crypto Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Modal content will be populated by JavaScript -->
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>