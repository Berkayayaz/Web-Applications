<?php
session_start();

include_once('../utils/utils.php');
include_once('../common/globals.php');
require_once('../model/database.php');

if (!isset($_SESSION['email'])) {
    header('Location: .');
}

$user_id = $_SESSION['user_id'];
$query_user = 'SELECT * FROM `user` WHERE email = :email';
$statement = $db->prepare($query_user);
$statement->bindValue(':email', $_SESSION['email']);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();

$query_info = 'SELECT MAX(`test`.score) AS highestScore, passed, categoryName, COUNT(`test`.testID) AS attempts FROM `test` INNER JOIN `category`
  ON `test`.categoryID = `category`.categoryID WHERE `test`.userID = :id GROUP BY `category`.categoryName';
$statement2 = $db->prepare($query_info);
$statement2->bindValue(':id', $user_id);
$statement2->execute();
$tests = $statement2->fetchAll();
$statement2->closeCursor();
$status_profile = 0; //dont show
$status_pass = 0; //dont show

if (!isset($user)) {
    header('Location: login.php');
}

if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address'])) {

    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    try {
        $query_user = 'SELECT email FROM `user` WHERE email = :email';
        $statement = $db->prepare($query_user);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user_email = $statement->fetch();
        $statement->closeCursor();

        $update_user = 'UPDATE `user` SET firstName = :first_name, lastName = :last_name, gender = :gender, email = :email, phone = :phone, address = :address WHERE userId = :userId';
        $statement2 = $db->prepare($update_user);
        $statement2->bindValue(':first_name', $first_name);
        $statement2->bindValue(':last_name', $last_name);
        $statement2->bindValue(':gender', $gender);
        $statement2->bindValue(':email', $email);
        $statement2->bindValue(':phone', $phone);
        $statement2->bindValue(':address', $address);
        $statement2->bindValue(':userId', $user["userId"]);
        $statement2->execute();

        $query_user = 'SELECT * FROM `user` WHERE email = :email';
        $statement = $db->prepare($query_user);
        $statement->bindValue(':email', $_SESSION['email']);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        $status_profile = 1; //success updating info
    } catch (PDOException $e) {
        echo $e;
    }
}

if (isset($_POST['old-pass']) && isset($_POST['new-pass']) && isset($_POST['confirm-pass'])) {
    $old_pass = $_POST['old-pass'];
    $new_pass = $_POST['new-pass'];
    $confirm_pass = $_POST['confirm-pass'];

    if ($old_pass == $user['password']) {

        if ($new_pass == $confirm_pass) {

            try {

                $update_user = 'UPDATE `user` SET password = :password WHERE userId = :userId';
                $statement2 = $db->prepare($update_user);
                $statement2->bindValue(':password', $new_pass);
                $statement2->bindValue(':userId', $user["userId"]);
                $statement2->execute();

                $status_pass = 3; //success changing pass
            } catch (PDOException $e) {
                echo $e;
            }
        } else {
            $status_pass = 2; //new passwords dont match
        }
    } else {
        $status_pass = 1; //old pass doesnt match
    }
}

include('../view/header.php');
include('../view/user_menu_bar.php');
?>

<?php
if ($status_profile == 1) {
    show_success('Profile updated successfully', 'Success');
}

switch ($status_pass) {
    case 1:
        show_error('Your old password is incorrect', 'Error');
        break;
    case 2:
        show_error("Your new passwords don't match", 'Error');
        break;
    case 3:
        show_success('Password changed successfully', 'Success');
        break;
}
?>

<div class="container" 
     style="#test-label, #attempts-label, #score-label {font-weight: 300;}">
    <div class="main">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="page-header">Profile</h1>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav nav-pills nav-stacked" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Edit profile</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Change password</a></li>
                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Summary</a></li>
                        </ul>
                    </div>

                    <div class=" col-md-9 tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="row">
                                    <div class="col-md-2 text-right">
                                        <label for="first-name">First name</label>
                                    </div>
                                    <div class="col-md-4 form-group">
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
                                            <option value="">Select gender</option>
                                            <option value="male" <?php if($user["gender"] == "male") echo 'selected="selected"' ?>>Male</option>
                                            <option value="female" <?php if($user["gender"] == "female") echo 'selected="selected"' ?>>Female</option>
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
                                    <div class="col-md-2 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="profile">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="row">
                                    <div class="col-md-2 text-right">
                                        <label for="old-pass">Old password</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="password" id="old-pass" name="old-pass" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 text-right">
                                        <label for="new-pass">New password</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="password" id="new-pass" name="new-pass" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 text-right">
                                        <label for="confirm-pass">Confirm new password</label>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <input type="password" id="confirm-pass" name="confirm-pass" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary">Change password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages">
                            <form action="profile.php" method="POST">
                                <?php if (count($tests) == 0) { echo "You haven't taken any test"; } ?>
                                <?php foreach ($tests as $test) : ?>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label for="test">Test:</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label id="test-label"><?php echo $test['categoryName']; ?></label>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label for="attempts">Attempts:</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label id="attempts-label"><?php echo $test['attempts']; ?></label>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <label for="score">Highest score:</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label id="score-label"><?php echo $test['highestScore'] . '/10'; ?></label>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>