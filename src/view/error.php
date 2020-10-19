<?php
// unset and destroy session
if(isset($_SESSION['loggedin'])) {
  session_unset();
  session_destroy();
}
?>

<div class="wrapper home">
  <!-- page content -->
  <div class="center-div">
    <!-- error message -->
    <div class="jumbotron">
      <h1 class="display-4">Oups, something went wrong.</h1>
      <p class="lead">The application did not respond. To use the system again, please log in.</p>
      <hr class="my-4">
      <p class="lead">Click here to log in:</p>
      <p class="lead">
        <a class="btn btn-success btn-lg" href="../public/login.php" role="button">LogIn</a>
      </p>
    </div>
  </div>
</div>