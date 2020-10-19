<?php
// initialize variables
$current_user = '';

// delete user
if(isset($_POST['delete_user'])) {
  // assign new data to variables
  $confirmation = $_POST['confirmation'];
  $current_user = $_POST['select_user'];
  // check if confirmation is correct
  if($confirmation != ('I ' . $username . ' agree') || empty($current_user)) {
    $error = 'Could not delete user.';
  }
  // if no error, delete user
  if(empty($error)) {
    // create query
    $query = 'DELETE FROM tbl_users WHERE username = ?';
    // execute query
    if(!$mysqli -> query($query)) $error = 'Could not delete user';
    // no error
    if (empty($error)) {
      $message =  "User successfully deleted.";
      $mysqli->close();
    }
  }
}
?>