<?php
// create new user
if(isset($_POST['create-user'])) {
  $lv_firstname = $_POST['firstname'];
  $lv_lastname = $_POST['lastname'];
  $lv_username = $_POST['username'];
  $lv_password = $_POST['password'];
  $lv_usergroup = $_POST['usergroup'];
  $lv_userclass = $_POST['class'];
  // trim and sanitize
  $lv_first = trim(htmlspecialchars($lv_firstname));
  if(strlen($lv_firstname) > 40){
    $error .= 'Please enter a correct firstname.<br />';
  }
  $lv_last = trim(htmlspecialchars($lv_lastname));
  if(strlen($lv_lastname) > 40){
    $error .= 'Please enter a correct lastname.<br />';
  }
  $lv_user= trim($lv_username);
  if(!preg_match('(.*[a-z]\.[a-z].*)', $lv_username)){
    $error .= 'Please enter a correct username.<br />';
  }
  $lv_pass= trim($lv_password);
  if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,255}$/', $lv_password)){
    $error .= 'Please enter a correct password.<br />';
  }
  // check if empty
  if(empty($lv_first) || empty($lv_last) || empty($lv_user) || empty($lv_pass) || $lv_usergroup == 'Choose...'|| $lv_userclass == 'Choose...') {
    $error = 'Could not create new user.';
  }
  // if no error, create user
  if(empty($error)) {
    try {
      $query = 'INSERT INTO tbl_users VALUES (NULL, ?, ?, ?, ?, ?, ?)';
      $stmt = $mysqli->prepare($query);
      $lv_pw = password_hash($lv_pass, PASSWORD_DEFAULT);
      $lv_group = intval($lv_usergroup);
      $lv_class = NULL;
      if($lv_userclass != 'None') $lv_class = intval($lv_userclass);
      $stmt->bind_param('ssssii', $lv_first, $lv_last, $lv_user, $lv_pw, $lv_group, $lv_class);
      $stmt->execute();
    } catch(Exeption $e) {
      error_log($e->getMessage());
      $error = 'Could not create new user.';
    }
    if (empty($error)) {
      $message =  "User successfully created.";
      $mysqli->close();
    }
  }
}
?>