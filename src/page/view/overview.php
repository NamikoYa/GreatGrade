<?php
// initialize variables
$subject = '';
ob_start();

// change of select option
if(isset($_POST['btn_view'])) {
  if (isset($_POST['subjectValue'])){
    $subject = $_POST['subjectValue'];
  } else $subject = '';
} else if($_SERVER['REQUEST_METHOD'] == 'POST') { // save changed data in table
  // TODO: saving table
}

// TODO: edit buttons -> make work
?>

<div class="wrapper overview">

  <div class="center-div">

    <!-- grades panel -->
    <div class="card text-white bg-dark mb-3">
      <h5 class="card-header">Grade Overview</h5>
      <div class="card-body">
        <!-- select options for subject -->
        <form method="post">
          <div class="input-group">
            <select class="custom-select" name="subjectValue">
              <option <?php if($subject == '') echo 'selected'; ?> disabled>Subject</option>
              <!-- get subject options from database -->
              <?php
              $query = "SELECT * FROM tbl_subjects";
              $stmt = $mysqli->prepare($query);
              $stmt->execute();
              $result=$stmt->get_result();
              
              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
              ?>
              <option <?php if($subject == $row['subject']) echo 'selected'; ?>><?php echo $row['subject']?></option>
              <?php
                }
              }
              $result->free();
              ?>
            </select>
            <div class="input-group-append">
              <button class="btn btn-success" type="submit" name="btn_view">View</button>
            </div>
          </div>
        </form>
        <hr class="my-4 bg-light">
        
        <!-- table with grades -->
        <form id="form_table" method="post">
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
                $query = '';
                if($group != 3) $query = "SELECT u.firstname, u.lastname, u.username, s.subject, g.grade FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID where s.subject = ? order by u.lastname";
                else $query = "SELECT u.firstname, u.lastname, u.username, s.subject, g.grade FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID where s.subject = ? and classID = ? order by u.lastname";
                $stmt = $mysqli->prepare($query);
                if($group != 3) $stmt->bind_param("s", $subject);
                else $stmt->bind_param("ss", $subject, $class);
                $stmt->execute();
                $result=$stmt->get_result();

                if($result->num_rows > 0) {
                  $count = 0;
                  while($row = $result->fetch_assoc()){
                    if(($count % 2) != 0) {
                      echo '<tr class="bg-success">';
                    } else {
                      echo '<tr>';
                    }
                    echo '<th scope="row">' . ($count + 1) . '</th>';
                    echo '<td>' . $row['firstname'] . '</td>';
                    echo '<td>' . $row['lastname'] . '</td>';
                    echo '<td class="grade_td" contenteditable="false">' . $row['grade'] . '</td>';
                    echo '</tr>';
                    $count++;
                  }
                }
                $result->free();
              }
              ?>
            </tbody>
          </table>
        </form>
        <?php if($group == 1 || $group == 2) { ?>
          <button id='btn_edit_id' class="btn_edit">Edit List</button>
        <?php } ?>
      </div>
    </div>

  </div>

    <!-- modal editor -->
    <form method="post">
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Grade</h5>
          </div>
          <div class="modal-body">
            <!-- modal content -->
            <div class="form-group">
              <input type="text" name="grade" id="grade" class="form-control input_user" value="" placeholder="edit grade..."maxlength="3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>