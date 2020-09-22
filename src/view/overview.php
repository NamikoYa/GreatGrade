<?php
// initialize variables
$subject = '';

// change of select option
if(isset($_POST['btn_view'])) {
  if (isset($_POST['subjectValue'])){
    $subject = $_POST['subjectValue'];
  }else $subject = '';
  }

// TODO: edit buttons -> make work
// TODO: press view subjec throws error -> ask brodbeck
?>

<div class="wrapper overview">

  <div class="center-div">

    <!-- Grades Panel -->
    <div class="card text-white bg-dark mb-3">
      <h5 class="card-header">Grade Overview</h5>
      <div class="card-body">
        <!-- Select options for subject -->
        <form method="post">
          <div class="input-group">
            <select class="custom-select" name="subjectValue">
              <option <?php if($subject == '') echo 'selected'; ?> disabled>Subject</option>
              <!-- Get subject options from database -->
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
        
        <!-- Table with grades -->
        <table class="table table-hover table-dark">
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
                  echo '<td>' . $row['grade'] . '</td>';
                  // TODO: clean up
                  if($group == 1 || $group == 2) {
                    echo '<td style="width: 80px;"><button style="padding-top: 2px; height: 25px; font-size: 10pt;" type="button" class="edit">Edit</button></td>';
                  }
                  echo '</tr>';
                  $count++;
                }
              }
              $result->free();
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>