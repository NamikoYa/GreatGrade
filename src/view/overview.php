<?php
// TODO: How to change variable in select option? Changes dynamically already -> do not change
$subject = 'History';
// TODO: If accessgroup = teacher OR admin, add td to table with edit button -> add modal with entry field for grade and functional sql query
// https://www.tutorialrepublic.com/codelab.php?topic=bootstrap&file=table-with-add-and-delete-row-feature
?>

<div class="wrapper overview">

  <div class="center_div">

    <!-- Grades Panel -->
    <div class="card text-white bg-dark mb-3">
      <h5 class="card-header">Grade Overview</h5>
      <div class="card-body">
        <!-- Select options for subject -->
        <label class="mr-sm-2" for="inlineFormCustomSelect">Subject</label>
        <select name="subjectSelect" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
          <option selected disabled>Choose...</option>
          <!-- Get subject options from database -->
          <?php
          $query = "SELECT * FROM tbl_subjects";
          $stmt = $mysqli->prepare($query);
          $stmt->execute();
          $result=$stmt->get_result();
          
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
              echo '<option>' . $row['subject'] . '</option>';
            }
          }
          $result->free();
          ?>
        </select>
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
            if($subject != '') {
              $query = "SELECT u.firstname, u.lastname, u.username, s.subject, g.grade FROM tbl_grades as g INNER JOIN tbl_users as u on g.studentID = u.ID INNER JOIN tbl_subjects as s on g.subjectID = s.ID where s.subject = ? order by u.lastname";
              $stmt = $mysqli->prepare($query);
              $stmt->bind_param("s", $subject);
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
                  if($group == 1 || $group == 2) echo '<td style="width: 80px;"><button id="edit" style="padding-top: 2px; height: 25px; font-size: 10pt;" type="button" class="btn btn-light">Edit</button></td>';
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