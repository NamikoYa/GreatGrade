<?php

// Start session
session_start();

// Display errors
ini_set('display_errors', true);

// Include controller
include '../controller.php';
// Include database connection
include '../db_connector.php';

// Initialize variables
$firstname = $lastname = $username = $password = $group = '';

// Get Data and fill variables
if(isset($_SESSION['loggedin'])) {
  $username = $_SESSION['username'];
  try {
    $query = "SELECT firstname, lastname, username, password, groupID FROM tbl_users WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result=$stmt->get_result();
  } catch(Exeption $e) {
    error_log($e->getMessage());
    $view = 'error';
  }
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $password = $_SESSION['password'];
      $group = $row['groupID'];
    }
  } else {
    $view = 'error';
  }
  $result->free();
} else {
  $view = 'error';
}

?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="../css/gg_stylesheet.css">

  <title>GreatGrade</title>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="?view=home">GG</a>
    <div class="collapse navbar-collapse">
      <div class="navbar-nav">
        <a href="?view=home" class="nav-item nav-link <?php if($view == 'home') { echo 'active'; } ?>">Home</a>
        <a href="?view=overview" class="nav-item nav-link <?php if($view == 'overview') { echo 'active'; } ?>">Overview</a>
        <a href="?view=settings" class="nav-item nav-link <?php if($view == 'settings') { echo 'active'; } ?>">My Settings</a>
      </div>
      <div class="navbar-nav ml-auto">
        <a href="./login.php" class="nav-item nav-link">Log out</a>
      </div>
    </div>
  </nav>

  <?php 
  // Display view according view-parameter
  switch ($view) {
    case 'home':
      include '../view/home.php'; break;
    case 'overview':
      include '../view/overview.php'; break;
    case 'settings':
      include '../view/settings.php'; break;
    default:
      include '../view/error.php'; break;
  }
  ?>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="../js/myscript.js"></script>

</body>

</body>
</html>

<!-- switch , &, validation in controller -->