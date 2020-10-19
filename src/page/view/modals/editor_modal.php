<?php
// execute query
if(isset($_POST['btn_editor'])) {
  // assign new data to variables
  $confirmation = $_POST['confirmation2'];
  $entered_query = $_POST['editor_text'];
   // check if confirmation is correct
  if($confirmation != ('I ' . $username . ' agree') || empty($entered_query)) {
    $error = 'Query was not able to execute';
  }
  // if no error, execute query
  if(empty($error)) {
    // execute entered query
    if(!$mysqli -> query($entered_query)) $error = $mysqli -> error;
    if (empty($error)) {
      $message =  "Query successfully executed.";
      $mysqli->close();
    }
  }
}
?>