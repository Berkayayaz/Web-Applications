<?php
    session_start();
    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    require_once('../model/database.php');
    $creation_status = 0;

    if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['password'])) {
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        try {
            $query_user = 'SELECT email FROM `user` WHERE email = :email';
            $statement = $db->prepare($query_user);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user_email = $statement->fetch();
            $statement->closeCursor();

            if (isset($user_email['email'])) {
                $creation_status = 1;
            } else {
                $insert_user = 'INSERT INTO `user` (firstName, lastName, gender, email, phone, address, password, isAdmin) VALUES (:first_name, :last_name, :gender, :email, :phone, :address, :password, :isAdmin)';
                $statement2 = $db->prepare($insert_user);
                $statement2->bindValue(':first_name', $first_name);
                $statement2->bindValue(':last_name', $last_name);
                $statement2->bindValue(':gender', $gender);
                $statement2->bindValue(':email', $email);
                $statement2->bindValue(':phone', $phone);
                $statement2->bindValue(':address', $address);
                $statement2->bindValue(':password', $password);
                $statement2->bindValue(':isAdmin', false);
                $statement2->execute();
                $creation_status = 2;

                $_SESSION['email'] = $email;
                header('Location: .');
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Register</title>
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/register.css">

        <script src="../js/jquery-2.2.4.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="../css/toastr.min.css">
        <script src="../js/toastr.min.js"></script>
    </head>
    <body>
        <?php
            if ($creation_status == 2) {
                show_success('Your user has been created', 'Success');
            } else if ($creation_status == 1) {
                show_error('This email is already in use', 'Error');
            }
        ?>
        <main class="container">
            <div class="row">
                <div class="panel panel-default" style="text-align: center">
                    <div class="panel-body">
                        <div class="col-md-4 col-md-offset-4 form-container">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <h1 class="text-center">Sign up</h1>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first-name" placeholder="First name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last-name" placeholder="Last name" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="gender" required>
                                        <option value="">Select gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="form-group">
                                    <input type="address" class="form-control" name="address" placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <button class="btn btn-primary btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>