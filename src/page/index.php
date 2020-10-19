<?php
// start session
session_start();

// display errors
ini_set('display_errors', true);

// include controller
include '../controller.php';

// initialize variables
$firstname = $lastname = $username = $password = $group = $class = '';

// get data and fill variables
if(isset($_SESSION['loggedin'])) {
  // get username of session
  $username = $_SESSION['username'];
  // create query
  $query = "SELECT firstname, lastname, username, password, groupID, classID FROM tbl_users WHERE username = ?";
  // prepare()
  if(!$stmt = $mysqli->prepare($query)) $view = 'error';
  // bind_param()
  if(!$stmt->bind_param('s', $username)) $view = 'error';
  // execute stmt
  if(!$stmt->execute()) $view = 'error';
  // no error
  if($view != 'error') {
    // get results
    $result=$stmt->get_result();
    // cycle through results and assign to variables
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $password = $_SESSION['password'];
        $group = $row['groupID'];
        $class = $row['classID'];
      }
    } else {
      $view = 'error';
    }
    $result->free();
  }
} else {
  $view = 'error';
}

?>

<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- stylesheets -->
    <link rel="stylesheet" type="text/css" href="../css/main_layout.css">

    <title>GreatGrade</title>
  </head>
  <body>
    <!-- navigation bar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="?view=home">GG</a>
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <a href="?view=home" class="nav-item nav-link <?php if($view == 'home') { echo 'active'; } ?>">Home</a>
          <a href="?view=overview" class="nav-item nav-link <?php if($view == 'overview') { echo 'active'; } ?>">Overview</a>
          <a href="?view=settings" class="nav-item nav-link <?php if($view == 'settings') { echo 'active'; } ?>">My Settings</a>
        </div>
        <div class="navbar-nav ml-auto">
          <a href="../public/login.php" class="nav-item nav-link">Log out</a>
        </div>
      </div>
    </nav>

    <?php 
    // display view according view-parameter
    switch ($view) {
      case 'home':
        include './view/home.php'; break;
      case 'overview':
        include './view/overview.php'; break;
      case 'settings':
        include './view/settings.php'; break;
      default:
        include './view/error.php'; break;
    }
    ?>

    <!-- jquery first, then popper.js, then bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/eventHandler.js"></script>

  </body>

</html>

<!-- switch in controller -->