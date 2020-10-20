<?php
// initialize variables
$current_user = '';
$user_id = $data_grade = $grade = 0;

// delete user
if(isset($_POST['btn_save_grade'])) {
	// assign new data to vriables
	$current_user = $_POST['select_table_user'];
	$data_grade = $_POST['grade'];
	// sanitize
	$grade = trim(htmlspecialchars($data_grade));
	if(!preg_match('(.*[1-6]{1}\.[0-9]{1,2})', $grade)) $error = 'Could not update grade.';
	if(empty($error)) {
		// create query
		$query = "SELECT DISTINCT g.studentID FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID where u.username = ?";
		// prepare()
		if(!$stmt = $mysqli->prepare($query)) $error = 'Could not update grade.';
		// bind_param()
		if(!$stmt->bind_param('s', $current_user)) $error = 'Could not update grade.';
		// execute
		if(!$stmt->execute()) $error = 'Could not update grade.';
		// get results
		if(!$result=$stmt->get_result()) $error = 'Could not update grade.';
		// cycle and assign results
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$user_id = $row['studentID'];
			}
		} else $error = 'Could not update grade.';
		$result->free();

		if($user_id != 0) {
			// create query
			$query = "UPDATE tbl_grades SET grade= ? WHERE studentID = ?";
			// prepare()
			if(!$stmt = $mysqli->prepare($query)) $error = 'Could not update grade.';
			// bind_param()
			if(!$stmt->bind_param('di', $grade, $user_id)) $error = 'Could not update grade.';
			// execute
			if(!$stmt->execute()) $error = 'Could not update grade.';
		}
	}	
    if (empty($error)) {
      $message =  "Grade successfully updated.";
      $mysqli->close();
    }
}
?>