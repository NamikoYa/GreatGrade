<?php
// TODO: Destroy session if exists
session_destroy();
?>

<div class="wrapper home">
  <!-- Page Content -->
  <div class="center_div">
    <!-- Error Message -->
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