<?php 
// Display errors
ini_set('display_errors', true);

// Include controller
include '../controller.php';

// Include database connection
include '../db_connector.php';
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
    </div>
  </nav>

  <?php 
  // display view according view-parameter
  switch ($view) {
    case 'overview':
      include '../view/overview.php'; break;
    case 'settings':
      include '../view/settings.php'; break;
    default:
      include '../view/home.php'; break;
  }
  ?>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</body>
</html>

<!-- switch , &, validation in controller -->