<?php
require('../model/database.php');
require('../model/query/db_user.php');

if (isset($_POST['update_user_btn'])) {
    if (isset($_POST['first-name']) && isset($_POST['last-name']) && 
            isset($_POST['gender']) && isset($_POST['email']) && 
            isset($_POST['phone']) && isset($_POST['address'])) {

        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $user_id = $_POST['user-id'];
     

        try {
            update_user($user_id, $first_name, $last_name, $gender, $email, $phone, $address);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
if (isset($_POST['delete_user_btn'])) {
    $user_id = $_POST['user_id_delete'];
    delete_tests_of_user($user_id);
    delete_user($user_id);
}
$allUsers = get_all_users();

include('../view/header.php');
include('../view/admin_menu_bar.php');
?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         

          <h1 class="page-header">User List</h1>
          <div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="Search..">
</div>
          <span class="counter pull-right"></span>
            <table class="table table-hover table-bordered results">
              <thead>
                <tr>
                    <th>User ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Gender</th>
                  <th>E-Mail</th>
                   <th>Phone</th>
                    <th>Address</th>
                     <th>Type</th>
                     <th></th>
                </tr>
              </thead>
              <tbody>
                      <tr class="warning no-result">
      <td colspan="9"><i class="fa fa-warning"></i> No result</td>
    </tr>
                <?php foreach ($allUsers as $allUser) : ?>
            <tr>
                <td><?php echo ($allUser['userId']); ?></td>
                <td><?php echo $allUser['firstName']; ?></td>
                 <td><?php echo $allUser['lastName']; ?></td>
                <td><?php echo $allUser['gender']; ?></td>
                 <td><?php echo $allUser['email']; ?></td>
                <td><?php echo $allUser['phone']; ?></td>
                 <td><?php echo $allUser['address']; ?></td>
                <td class="right">
                <?php  if(($allUser['isAdmin']) == 1){
                	echo 'Admin';
                
                }else{
                	echo 'User';
                }
                
                
               
                 ?> </td>
                
               
                <td><form action="edit_user_admin.php" method="post">
                    <input type="hidden" name="action"
                           value="edit_user">
                    <input type="hidden" name="user_id" id="user_id"
                           value="<?php echo $allUser['userId']; ?>">
                  
                    <input class="btn-warning" type="submit" value="Edit">
                </form></td>
            </tr>
            <?php endforeach; ?>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-2.2.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/searchbar.js"></script>
    
 <?php include '../view/footer.php'; ?>
