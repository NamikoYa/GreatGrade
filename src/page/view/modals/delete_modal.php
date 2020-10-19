<?php
// initialize variables
$current_user = '';

// delete user
if(isset($_POST['delete_user'])) {
  $confirmation = $_POST['confirmation'];
  $current_user = $_POST['select_user'];
  if($confirmation != ('I ' . $username . ' agree') || empty($current_user)) {
    $error = 'Could not delete user.';
  }
  // if no error, delete user
  if(empty($error)) {
    $query = 'DELETE FROM tbl_users WHERE username = ?';
    if(!$mysqli -> query($query)) $error = 'Could not delete user';
    if (empty($error)) {
      $message =  "User successfully deleted.";
      $mysqli->close();
    }
  }
}
?>