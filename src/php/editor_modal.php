<?php
// execute query
if(isset($_POST['btn_editor'])) {
  $confirmation = $_POST['confirmation2'];
  $entered_query = $_POST['editor_text'];
  if($confirmation != ('I ' . $username . ' agree') || empty($entered_query)) {
    $error = 'Could not delete user.';
  }
  // if no error, execute query
  if(empty($error)) {
    if(!$mysqli -> query($entered_query)) $error = $mysqli -> error;
    if (empty($error)) {
      $message =  "Query successfully executed.";
      $mysqli->close();
    }
  }
}
?>