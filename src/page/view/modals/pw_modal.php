<?php
// initialize variables
$pattern = '/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,255}$/';

// change password
if(isset($_POST['change-pass'])) {
  // assign new data to variables
  $new1 = $_POST['new1'];
  $new2 = $_POST['new2'];
  // compare
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
    // create query
    $query = 'UPDATE tbl_users SET password = ? WHERE username = ?';
    // prepare()
    if(!$stmt = $mysqli->prepare($query)) $error = 'Could not change password.';
    // hash password
    $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);
    // bind_param()
    if(!$stmt->bind_param('ss', $hashedPass, $username)) $error = 'Could not change password.';
    // execute()
    if(!$stmt->execute()) $error = 'Could not change password.';
    // no error
    if (empty($error)) {
      $message =  'Password successfully changed.';
      $_SESSION['password'] = $newPass;
      $password = $newPass;
      $mysqli->close();
    }
  }
}
?>