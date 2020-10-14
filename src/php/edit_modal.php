<?php
// execute query
if(isset($_POST['btn_save'])) {
  $edit_grade = $_POST['grade'];
  echo $edit_grade;
}
    // if no error, edit grade
    /*if(empty($error)) {
      try {
        $query = 'INSERT INTO tbl_grades (grade) WHERE VALUES (?)';
        $stmt = $mysqli->prepare($query);
        if($stmt === false){
          $error .= 'prepare() failed '. $mysqli->error . '<br>';
        }
        
        $stmt->bind_param('i', $grade);
        $stmt->execute();
      } catch(Exeption $e) {
        error_log($e->getMessage());
        $error = 'Could not edit the grade.';
      }
      if (empty($error)) {
        $message =  "Grade successfully saved in the system.";
        $mysqli->close();
      }
    }
}
?>
