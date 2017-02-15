 <?php 
require('../model/database.php');
require('../model/query/db_user.php');

$allUsers = get_all_users();
$selectedUserId = filter_input(INPUT_POST, 'user_id',FILTER_VALIDATE_INT);
$user = get_user_by_userid($selectedUserId);

include('../view/header.php');
include('../view/admin_menu_bar.php');
 ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Edit User</h1>

       <div class="row">
      
                <form action="user_admin.php" method="POST">
                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="first-name">First name</label><br>
                       
                      </div>
                      <div class="col-md-4 form-group">
                      <input type="hidden" id="user-id" name="user-id" value="<?php echo $user["userId"]; ?>" >
                        <input type="text" id="first-name" name="first-name" class="form-control" value="<?php echo $user["firstName"]; ?>" required>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="last-name">Last name</label>
                      </div>
                      <div class="col-md-4 form-group">
                        <input type="text" id="last-name" name="last-name" class="form-control" value="<?php echo $user["lastName"]; ?>" required>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="gender">Gender</label>
                      </div>
                      <div class="col-md-4 form-group">
                        <select id="gender" name="gender" class="form-control">
                          
                          <option value="male" <?php if($user["gender"] == "male"){ echo 'selected';} ?>>Male</option>
                          <option value="female" <?php if($user["gender"] == "female"){ echo 'selected';} ?>>Female</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="email">Email</label>
                      </div>
                      <div class="col-md-4 form-group">
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $user["email"]; ?>" required>
                      </div>
                    </div>
                

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="address">Address</label>
                      </div>
                      <div class="col-md-4 form-group">
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo $user["address"]; ?>" required>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="phone">Phone</label>
                      </div>
                      <div class="col-md-4 form-group">
                        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $user["phone"]; ?>" required>
                      </div>
                    </div>
                   

                    <div class="row">
                        <div class="form-group">
                      <div class="col-sm-2 col-md-offset-2 form-group">
                        <button type="submit" id="update_user_btn" name="update_user_btn"  class="btn btn-primary form-control">Update</button>
                      
                       </div>
                        
                       
                          <div class="col-sm-2 form-group">
                          
                          <input type="hidden" name="user_id_delete" id="user_id_delete" value="<?php echo $user['userId']; ?>">
                        <button type="submit" id="delete_user_btn" name="delete_user_btn"  class="btn btn-danger form-control" >Delete</button>
                      </div>
                      </div> 
                        </div> 
                       </form>  
                        
                       </div>
			  </div></div>
 

      
        </div>

<?php include '../view/footer.php'; ?>
