<?php
// initialize variables
$subject = $current_user = $error = $message = '';

// include needed modal
include './view/modals/edit_modal.php';

// change of select option
if(isset($_POST['btn_view'])) {
  if (isset($_POST['select_subject'])){
    // assign change to variable
    $subject = $_POST['select_subject'];
  } else $subject = '';
}
?>

<div class="wrapper overview">
  <div class="center-div">
    <?php
      // print error or message
      if(!empty($message)){
        echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
      } else if(!empty($error)){
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
      }
    ?>
    <!-- grades panel -->
    <form method="post">
      <div class="card text-white bg-dark mb-3">
        <h5 class="card-header">Grade Overview</h5>
        <div class="card-body">
          <!-- select options for subject -->
          <div class="input-group">
            <select id="select_subject_id" class="custom-select" name="select_subject">
              <option <?php if($subject == '') echo 'selected'; ?> disabled>Subject</option>
              <!-- get subject options from database -->
              <?php
              // create query
              $query = "SELECT * FROM tbl_subjects";
              // prepare()
              if(!$stmt = $mysqli->prepare($query)) $error = 'Could not load selector. Please try again.';
              // execute()
              if(!$stmt->execute()) $error = 'Could not load selector. Please try again.';
              // get results
              if(!$result=$stmt->get_result()) $error = 'Could not load selector. Please try again.';
              // cycle and output results
              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
              ?>
              <option <?php if($subject == $row['subject']) echo 'selected'; ?>><?php echo $row['subject']?></option>
              <?php
                }
              } else $error = 'Could not load selector. Please try again.';
              $result->free();
              ?>
            </select>
            <div class="input-group-append">
              <button id="btn_view_id" class="btn btn-success" type="submit" name="btn_view">View</button>
            </div>
          </div>
          <hr class="my-4 bg-light">
          
          <!-- table with grades -->
          <table name="table_grades" class="table table-hover table-dark">
            <caption>List of grades</caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Grade</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // fill table with data, students can only see their own class
              if($subject != '') {
                // create query based on access group
                $query = '';
                if($group != 3) $query = "SELECT u.firstname, u.lastname, u.username, s.subject, g.grade FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID where s.subject = ? order by u.lastname";
                else $query = "SELECT u.firstname, u.lastname, u.username, s.subject, g.grade FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID where s.subject = ? and u.classID = ? order by u.lastname";
                // prepare()
                if(!$stmt = $mysqli->prepare($query)) $error = 'Could not load table. Please try again.';
                // bind_param() based on access group
                if($group != 3) {
                  if($stmt->bind_param("s", $subject)) $error = 'Could not load table. Please try again.';
                }
                else {
                  if(!$stmt->bind_param("ss", $subject, $class)) $error = 'Could not load table. Please try again.';
                }
                // execute
                if(!$stmt->execute()) $error = 'Could not load table. Please try again.';
                // get results
                if(!$result=$stmt->get_result()) $error = 'Could not load table. Please try again.';
                // cycle and output results
                if($result->num_rows > 0) {
                  $count = 0;
                  while($row = $result->fetch_assoc()) {
                    if(($count % 2) != 0) {
                      echo '<tr class="bg-success">';
                    } else {
                      echo '<tr>';
                    }
                    echo '<th scope="row">' . ($count + 1) . '</th>';
                    echo '<td>' . $row['firstname'] . '</td>';
                    echo '<td>' . $row['lastname'] . '</td>';
                    echo '<td class="grade_td">' . $row['grade'] . '</td>';
                    echo '</tr>';
                    $count++;
                  }
                } else $error = 'Could not load table. Please try again.';
                $result->free();
              }
              ?>
            </tbody>
          </table>

          <?php
            // show/hide button based on access group 
            if($group == 1 || $group == 2) { 
          ?>
            <button type="button" class="btn_edit" data-toggle="modal" data-target="#edit" <?php if($subject==''){echo "disabled";} else{echo "";} ?>>Edit List</button>
          <?php } ?>
        </div>
      </div>
    </form>
  </div>

  <!-- modal editor -->
  <form method="post">
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Grades</h5>
          </div>
          <div class="modal-body">
            <!-- modal content -->
            <div class="form-group">
              <select required class="custom-select" name="select_table_user">
                <option <?php if($current_user == '') echo 'selected'; ?> disabled>Choose...</option>
                <!-- get usernames from database -->
                <?php
                // create query
                $query = "SELECT u.username FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID WHERE s.subject = ? AND username <> ?";
                // prepare()
                if(!$stmt = $mysqli->prepare($query)) $error = 'Could not identify users. Please try again.';
                // bind_param()
                if(!$stmt->bind_param('ss', $subject, $username)) $error = 'Could not identify users. Please try again.';
                // execute()
                if(!$stmt->execute()) $error = 'Could not identify users. Please try again.';
                // get results
                if(!$result=$stmt->get_result()) $error = 'Could not identify users. Please try again.';
                // cycle and output results
                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){
                ?>
                <option <?php if($current_user == $row['username']) echo 'selected'; ?>><?php echo $row['username']?></option>
                <?php
                  }
                } else $error = 'Could not identify users. Please try again.';
                $result->free();
                ?>
              </select>
            </div>
            <div class="form-group">
              <input required type="text" name="grade" id="grade" class="form-control input_user" value="" placeholder="Enter new grade" maxlength="4" pattern="(.*[1-6]{1}\.[0-9]{1,2})"
              title="Grades should contain one number between 1 and 6 with two decimal places">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="btn_save_grade" id="btn_save_grade" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>