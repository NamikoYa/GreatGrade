<div class="wrapper settings">

  <!-- Page Content -->
  <div class="center_div">

    <!-- Profile Panel -->
    <div class="card text-white bg-dark mb-3">
      <h5 class="card-header">Profile</h5>
      <div class="card-body">
        <div class="form-group row">
          <!-- User Info -->
          <label for="firstname" class="col-sm-2 col-form-label">Firstname:</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="firstname" value="Donald">
          </div>
        </div>
        <div class="form-group row">
          <label for="lastname" class="col-sm-2 col-form-label">Lastname:</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="lastname" value="Duck">
          </div>
        </div>
        <!-- Access Group Info -->
        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Access Group</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                <label class="form-check-label" for="gridRadios1">
                  Student
                </label>
              </div>
              <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2" disabled>
                <label class="form-check-label" for="gridRadios2">
                  Teacher
                </label>
              </div>
              <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
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
          <input disabled type="text" class="form-control" id="profileusername" value="firstname.lastname">
        </div>
        <div class="form-group">
          <label for="profilepassword">Password</label>
          <input disabled type="password" class="form-control" id="profilepassword" value="password">
        </div>
        <div class="right_sided">
          <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#changepassword">
            Change Password
          </button>
        </div>
      </div>
    </div>

    <!-- Administrator Panel -->
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

  </div>

  <!-- Modal Change Password -->
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
            <input type="password" class="form-control" id="password" aria-describedby="changeWarning" placeholder="Password">
            <small id="changeWarning" class="form-text text-muted">Your password needs to have 8 or more letters, one number and a special character included.</small>
          </div>
          <div class="form-group">
            <label for="repeatPassword">Repeat Password</label>
            <input type="password" class="form-control" id="repeatPassword" placeholder="Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Change Password</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal User Create -->
  <div class="modal fade" id="usercreate" tabindex="-1" role="dialog" aria-labelledby="usercreateTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Creat User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Modal Content -->
          <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" class="form-control" id="firstname" placeholder="Firstname">
          </div>
          <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" id="lastname" placeholder="Lastname">
          </div>
          <div class="form-group">
            <label for="user">Username</label>
            <input type="text" class="form-control" id="user" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Create</button>
        </div>
      </div>
    </div>
  </div>

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
          <div class="userlist">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action active">firstname.lastname</a>
              <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
              <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
              <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
              <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
              <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
              <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
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
  <div class="modal fade" id="userdelete" tabindex="-1" role="dialog" aria-labelledby="userdeleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
        </div>
        <div class="modal-body">
          <!-- Modal Content -->
          <form class="form-inline">
            <input class="form-control mr-sm-2 col-lg-9" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn btn-dark my-2 my-sm-0 col-lg-2" type="button"><i class="fa fa-search"></i></button>
          </form>
          <!-- TODO: create dynamic list, create <li> -->
          <div class="userlist">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action active">firstname.lastname</a>
              <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
              <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
              <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
              <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
              <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
              <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Editor -->
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
            <textarea class="form-control" id="editorField" rows="6" aria-describedby="editorWarning" placeholder="SQL-Statement"></textarea>
            <small id="editorWarning" class="form-text text-muted">Executing statements has direct impact on the database!</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Execute</button>
        </div>
      </div>
    </div>
  </div>

</div>