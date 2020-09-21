<?php
// TODO: Make modals work
// TODO: Cannot make changes with modals twice immediately, must reload?

// initialize variables
$error = $message = '';

// include database connection
include '../php/pw_modal.php';
include '../php/create_modal.php';
include '../php/delete_modal.php';
include '../php/editor_modal.php';
?>

<div class="wrapper settings">

  <!-- Page Content -->
  <div class="center-div">
    <?php
      // print error or message
      if(!empty($message)){
        echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
      } else if(!empty($error)){
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
      }
    ?>

    <!-- Profile Panel -->
    <div class="card text-white bg-dark mb-3">
      <h5 class="card-header">Profile</h5>
      <div class="card-body">
        <div class="form-group row">
          <!-- User Info -->
          <label for="firstname" class="col-sm-2 col-form-label">Firstname:</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="firstname" value="<?=$firstname?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="lastname" class="col-sm-2 col-form-label">Lastname:</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="lastname" value="<?=$lastname?>">
          </div>
        </div>
        <!-- Access Group Info -->
        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Access Group</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" <?php if($group == 3) {echo 'checked';} else {echo 'disabled';}?>>
                <label class="form-check-label" for="gridRadios1">
                  Student
                </label>
              </div>
              <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2" <?php if($group == 2) {echo 'checked';} else {echo 'disabled';}?>>
                <label class="form-check-label" for="gridRadios2">
                  Teacher
                </label>
              </div>
              <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" <?php if($group == 1) {echo 'checked';} else {echo 'disabled';}?>>
                <label class="form-check-label" for="gridRadios3">
                  Administrator
                </label>
              </div>
            </div>
          </div>
        </fieldset>
        <!-- Account Info -->
        <div class="form-group">
          <label for="profileusername">Username</label>
          <input disabled type="text" class="form-control" id="profileusername" value="<?=$username?>">
        </div>
        <div class="form-group">
          <label for="profilepassword">Password</label>
          <input disabled type="password" class="form-control" id="profilepassword" value="<?=$password?>">
        </div>
        <div class="right-sided">
          <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#changepassword">
            Change Password
          </button>
        </div>
      </div>
    </div>

    <!-- Administrator Panel -->
    <?php if($group == 1 || $group == 2) {?>
      <div class="card text-white bg-dark mb-3">
        <h5 class="card-header">Administrator Settings</h5>
        <div class="card-body">
          <button type="button" class="btn btn-light" data-toggle="modal" data-target="#usercreate">
            Create User
          </button>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#usermodify">
            Modify User
          </button>
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#userdelete">
            Delete User
          </button>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#editor">
            Connect Editor
          </button>
        </div>
      </div>
    <?php } ?>

  </div>

  <!-- Modal Change Password -->
  <form method="post">
    <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="changepasswordTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Modal Content -->
            <div class="form-group">
              <label for="password">Password</label>
              <input required type="password" name="new1" class="form-control" id="password" aria-describedby="changeWarning" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
              <small id="changeWarning" class="form-text text-muted">Your password needs to have 8 or more characters including one in uppercase, one number and a special character included.</small>
            </div>
            <div class="form-group">
              <label for="repeatPassword">Repeat Password</label>
              <input required type="password" name="new2" class="form-control" id="repeatPassword" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="change-pass" class="btn btn-danger">Change Password</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Modal User Create -->
  <form method="post">
    <div class="modal fade" id="usercreate" tabindex="-1" role="dialog" aria-labelledby="usercreateTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Modal Content -->
            <div class="form-group">
              <label for="firstname">Firstname</label>
              <input required name="firstname" type="text" class="form-control" id="firstname" placeholder="Firstname">
            </div>
            <div class="form-group">
              <label for="lastname">Lastname</label>
              <input required name="lastname" type="text" class="form-control" id="lastname" placeholder="Lastname">
            </div>
            <div class="form-group">
              <label for="user">Username</label>
              <input required name="username" type="text" class="form-control" id="user" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input required name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <!-- Select options for user group -->
            <div class="form-group">
              <label class="mr-sm-2" for="inlineFormCustomSelect">User Group</label>
              <select required name="usergroup" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected disabled>Choose...</option>
                <!-- Get user group options from database -->
                <?php
                $query = "SELECT * FROM tbl_usergroups";
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $result=$stmt->get_result();
                
                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){
                    echo '<option>' . $row['ID'] . '</option>';
                  }
                }
                $result->free();
                ?>
              </select>
            </div>
            <!-- Select options for class -->
            <div class="form-group">
              <label class="mr-sm-2" for="inlineFormCustomSelect">Class</label>
              <select required name="class" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected disabled>Choose...</option>
                <option>None</option>
                <!-- Get class options from database -->
                <?php
                $query = "SELECT * FROM tbl_classes";
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $result=$stmt->get_result();
                
                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){
                    echo '<option>' . $row['ID'] . '</option>';
                  }
                }
                $result->free();
                ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="create-user" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Modal Modify User -->
  <div class="modal fade" id="usermodify" tabindex="-1" role="dialog" aria-labelledby="usermodifyTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modify User</h5>
        </div>
        <div class="modal-body">
          <!-- Modal Content -->
          <form class="form-inline">
            <input class="form-control mr-sm-2 col-lg-9" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn btn-dark my-2 my-sm-0 col-lg-2" type="button"><i class="fa fa-search"></i></button>
          </form>
          <!-- TODO: create dynamic list, create <li> -->
          <div class="user-list">
            <div class="list-group">
              <?php
              try {
                $query = "SELECT username FROM tbl_users";
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $result=$stmt->get_result();
              } catch(Exeption $e) {
                error_log($e->getMessage());
                $view = 'error';
              }
              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                  echo '<a href="" class="list-group-item list-group-item-action">' . $row['username'] . '</a>';
                }
              } else {
                $view = 'error';
              }
              $result->free();
              ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete User -->
  <form method="post">
    <div class="modal fade" id="userdelete" tabindex="-1" role="dialog" aria-labelledby="userdeleteTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
          </div>
          <div class="modal-body">
            <!-- Modal Content -->
            <!-- TODO: dropdown with all users -->
            <div class="form-group">
              <select required class="custom-select" name="select_user">
                <option <?php if($current_user == '') echo 'selected'; ?> disabled>Choose...</option>
                <!-- Get subject options from database -->
                <?php
                $query = "SELECT username FROM tbl_users WHERE username <> ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $result=$stmt->get_result();
                
                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){
                ?>
                <option <?php if($current_user == $row['username']) echo 'selected'; ?>><?php echo $row['username']?></option>
                <?php
                  }
                }
                $result->free();
                ?>
              </select>
            </div>
            <div class="form-group">
              <input required type="text" name="confirmation" class="form-control" aria-describedby="confirmation_message" pattern="I <?php echo $username?> agree">
              <small id="confirmation_message" class="form-text text-muted">To continue deletion, write: I [ your username ] agree</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Modal Editor -->
  <form method="post">
    <div class="modal fade" id="editor" tabindex="-1" role="dialog" aria-labelledby="editorTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Editor</h5>
          </div>
          <div class="modal-body">
            <!-- Modal Content -->
            <div class="form-group">
              <input class="form-control" type="text" value="GGUser" readonly>
              <textarea class="form-control" name="editor_text" id="editorField" rows="6" aria-describedby="editorWarning" placeholder="SQL-Statement"></textarea>
              <small id="editorWarning" class="form-text text-muted">Executing statements has direct impact on the database!</small>
            </div>
            <div class="form-group">
              <input required type="text" name="confirmation2" class="form-control" aria-describedby="confirmation_message2" pattern="I <?php echo $username?> agree">
              <small id="confirmation_message2" class="form-text text-muted">To continue deletion, write: I [ your username ] agree</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="btn_editor" class="btn btn-danger">Execute</button>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>