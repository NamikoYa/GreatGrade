<?php
// initialize variables
$current_user = '';
$user_id = $data_grade = $grade = 0;

// delete user
if(isset($_POST['btn_save_grade'])) {
	$current_user = $_POST['select_table_user'];
	$data_grade = $_POST['grade'];
	$grade = trim(htmlspecialchars($lv_firstname));
	if(!preg_match('(.*[1-6]{1}\.[0-9]{1,2})', $grade)) $error = 'Could not update grade.'
	if(empty($error)) {
		$query = "SELECT DISTINCT g.studentID FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID where u.username = ?";
		if(!$stmt = $mysqli->prepare($query)) $error = 'Could not update grade.';
		if(!$stmt->bind_param('s', $current_user)) $error = 'Could not update grade.';
		if(!$stmt->execute()) $error = 'Could not update grade.';
		if(!$result=$stmt->get_result()) $error = 'Could not update grade.';
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$user_id = $row['studentID'];
			}
		} else $error = 'Could not update grade.';
		$result->free();

		if($user_id != 0) {
			$query = "UPDATE tbl_grades SET grade= ? WHERE studentID = ?";
			if(!$stmt = $mysqli->prepare($query)) $error = 'Could not update grade.';
			if(!$stmt->bind_param('di', $grade, $user_id)) $error = 'Could not update grade.';
			if(!$stmt->execute()) $error = 'Could not update grade.';
		}
		
    if (empty($error)) {
      $message =  "Grade successfully updated.";
      $mysqli->close();
    }
  }
}
?>