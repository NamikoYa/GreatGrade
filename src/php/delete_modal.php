<?php
// initialize variables
$current_user = '';

// delete user
if(isset($_POST['delete_user'])) {
  $confirmation = $_POST['confirmation'];
  $current_user = $_POST['select_user'];
  if($confirmation != ('I ' . $username . ' agree')) {
    $error = 'Could not delete user.';
  }
  // if no error, delete user
  if(empty($error)) {
    try {
      $query = 'DELETE FROM tbl_users WHERE username = ?';
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('s', $current_user);
      $stmt->execute();
    } catch(Exeption $e) {
      error_log($e->getMessage());
      $error = 'Could not delete user';
    }
    if (empty($error)) {
      $message =  "User successfully deleted.";
      $mysqli->close();
    }
  }
}
?>