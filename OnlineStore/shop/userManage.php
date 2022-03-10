<script>
  function addFunction() {
    swal('Done','','success').then((value) => {
              window.history.back(1);
            });
  }
  function failFunction() {
    swal('Fail','Do not have this product in the stock','error').then((value) => {
              window.history.back(1);
            });
  }
  function removeFunction() {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Poof! Your imaginary file has been deleted!", {
          icon: "success",
        });
      } else {
        swal("Your imaginary file is safe!");
      }
    }).then((value) => {
              window.history.back(1);
            });
  }
</script>
<div class="container-fluid" style="margin-top:98px">
	    <?php 
        $sql2 = "SELECT * FROM `shopuser` WHERE `shopuserId` = '$shopuserId'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $usertype = $row2['userType'];
        if ($usertype == 1) {

        ?>

	<div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#newUser"><i class="fa fa-plus"></i> New user</button>
        </div>
	</div>
	    <br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12 text-center">
                    <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th>UserId</th>
                            <th style="width:7%">Photo</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql = "SELECT * FROM shopuser WHERE `shopId`= $shopId "; 
                            $result = mysqli_query($conn, $sql);
                            
                            while($row=mysqli_fetch_assoc($result)) {
                                $shopuserId = $row['shopuserId'];
                                $username = $row['username'];
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                                $email = $row['email'];
                                $userType = $row['userType'];

                                if($userType == 1) 
                                    $userType = "Owner";
                                 if($userType == 2)                                
                                    $userType = "Employee";

                                echo '<tr>
                                    <td>' .$shopuserId. '</td>
                                    <td><img src="assetsForSideBar/img/person-' .$shopuserId. '.jpg" alt="image for this user" onError="this.src =\'assetsForSideBar/img/perfil.jpg\'" width="100px" height="100px"></td>
                                    <td>' .$username. '</td>
                                    <td>
                                        <p>First Name : <b>' .$firstname. '</b></p>
                                        <p>Last Name : <b>' .$lastname. '</b></p>
                                    </td>
                                    <td>' .$email. '</td>
                                    <td>' .$userType. '</td>
                                    <td class="text-center">
                                        <div class="row mx-auto" style="width:112px">
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editUser' .$shopuserId. '" type="button">Edit</button>';
                                            if($row['userType'] == 1) {
                                                echo '<button class="btn btn-sm btn-danger"  disabled style="margin-left:9px;">Delete</button>';
                                            }
                                            else {
                                                echo '<button onclick="removeUser(' . $shopuserId . ')" class="btn btn-sm btn-danger" style="margin-left:9px;">Delete</button>
                                                    ';
                                            }

                                    echo '</div>
                                    </td>
                                </tr>';
                            }
                        ?>
                    </tbody>
		        </table>
			</div>
		</div>
	</div>
<?php   }else {
    echo '
                <h2><b>You do not have a permission for this page.</b></h2>
          
        ';}?>
</div>

<!-- newUser Modal -->
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="newUser">Create New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_userManage.php" method="post">
              <div class="form-group">
                  <b><label for="username">Username</label></b>
                  <input class="form-control" id="username" name="username" placeholder="Choose a unique Username" type="text" required minlength="3" maxlength="11">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <b><label for="firstname">First Name:</label></b>
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-6">
                  <b><label for="lastname">Last name:</label></b>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" required>
                </div>
              </div>
              <div class="form-group">
                  <b><label for="email">Email:</label></b>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
              </div>
              <div class="form-group">
                  <b><label for="password">Password:</label></b>
                  <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
              </div>
              <div class="form-group">
                  <b><label for="password1">Renter Password:</label></b>
                  <input class="form-control" id="cpassword" name="cpassword" placeholder="Renter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
              </div>
              <button type="submit" name="createUser" class="btn btn-success">Submit</button>
            </form>
      </div>
    </div>
  </div>
</div>

<?php 
    $usersql = "SELECT * FROM `shopuser`";
    $userResult = mysqli_query($conn, $usersql);
    while($userRow = mysqli_fetch_assoc($userResult)){
        $Id = $userRow['shopuserId'];
        $name = $userRow['username'];
        $firstName = $userRow['firstname'];
        $lastName = $userRow['lastname'];
        $email = $userRow['email'];
        $userType = $userRow['userType'];


?>
<!-- editUser Modal -->
<div class="modal fade" id="editUser<?php echo $Id; ?>" tabindex="-1" role="dialog" aria-labelledby="editUser<?php echo $Id; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="editUser<?php echo $Id; ?>">User Id: <b><?php echo $Id; ?></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            
            <div class="text-left my-2 row" style="border-bottom: 2px solid #dee2e6;">
                <div class="form-group col-md-8">
                    <form action="partials/_userManage.php" method="post" enctype="multipart/form-data">
                        <b><label for="image">Profile Picture</label></b>
                        <input type="file" name="userimage" id="userimage" accept=".jpg" class="form-control" required style="border:none;">
                        <small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
                        <input type="hidden" id="shopuserId" name="shopuserId" value="<?php echo $Id; ?>">
                        <button type="submit" class="btn btn-success mt-3" name="updateProfilePhoto">Update Img</button>
                    </form>         
                </div>
                <div class="form-group col-md-4">
                    <img src="assetsForSideBar/img/person-<?php echo $Id; ?>.jpg" alt="Profile Photo" width="100" height="100" onError="this.src ='assetsForSideBar/img/perfil.jpg'">
                    <form action="partials/_userManage.php" method="post">
                        <input type="hidden" id="shopuserId" name="shopuserId" value="<?php echo $Id; ?>">
                        <button type="submit" class="btn btn-danger mt-2" name="removeProfilePhoto">Remove Img</button>
                    </form>
                </div>
            </div>
            
            <form action="partials/_userManage.php" method="post">
                <div class="form-group">
                    <b><label for="username">Username</label></b>
                    <input class="form-control" id="username" name="username" value="<?php echo $name; ?>" type="text" disabled>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <b><label for="firstName">First Name:</label></b>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <b><label for="lastName">Last name:</label></b>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
                </div>
                </div>
                <div class="form-group">
                    <b><label for="email">Email:</label></b>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <input type="hidden" id="shopuserId" name="shopuserId" value="<?php echo $Id; ?>">
                <button type="submit" name="editUser" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
  </div>
</div>

<?php
    }
?>