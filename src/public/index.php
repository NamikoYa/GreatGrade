<?php
/* TODO: 
cleanup 
-> comments english and starting small
-> local variables start with lv_, buttons = btn_
-> words in classes and variables are seperated with _
-> remove unnessecary classes, ids etc
-> get data in model
-> think about folder structure (php, what belongs into index?)
-> conform php writing (especially $query parts -> editor nicest! but not possible for binding.)
*/

// start session
session_start();

// display errors
ini_set('display_errors', true);

// include controller
include '../controller.php';
// include database connection
include '../db_connector.php';

// initialize variables
$firstname = $lastname = $username = $password = $group = $class = '';

// get data and fill variables
if(isset($_SESSION['loggedin'])) {
  $username = $_SESSION['username'];
  try {
    $query = "SELECT firstname, lastname, username, password, groupID, classID FROM tbl_users WHERE username = ?";
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
      $class = $row['classID'];
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
  // display view according view-parameter
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