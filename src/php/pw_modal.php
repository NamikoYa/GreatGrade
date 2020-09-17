<?php
// initialize variables
$pattern = '/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,255}$/';

// change password
if(isset($_POST['change-pass'])) {
  $new1 = $_POST['new1'];
  $new2 = $_POST['new2'];
  if($new1 == $new2) {
    // trim and sanitize
    $newPass = trim($new1);
    // check if empty and if within regex
    if(empty($newPass) || !preg_match($pattern, $newPass)) {
      $error = 'Could not change password.';
    }
  } else {
    $error = 'Could not change password.';
  }
  // if no error, save new password in database
  if(empty($error)) {
    try {
      $query = 'UPDATE tbl_users SET password = ? WHERE username = ?';
      $stmt = $mysqli->prepare($query);
      $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);
      $stmt->bind_param('ss', $hashedPass, $username);
      $stmt->execute();
    } catch(Exeption $e) {
      error_log($e->getMessage());
      $error = 'Could not change password.';
    }
    if (empty($error)) {
      $message =  'Password successfully changed.';
      // TODO: Is this secure?
      $_SESSION['password'] = $newPass;
      $password = $newPass;
      $mysqli->close();
    }
  }
}
?>