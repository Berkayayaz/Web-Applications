<?php
    session_start();
    
    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    require_once('../model/database.php');
    
    $creation_status = 0;

    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if ($email != NULL && $password != NULL) {
        // Delete spaces around email. It is case insensitive.
        $email = strtolower(trim($email));

        /* Admin user login */
        if ($email == ADMIN_EMAIL && $password == ADMIN_PASSWORD) {
            $_SESSION['email'] = ADMIN_EMAIL;
            $_SESSION['user_name'] = 'Admin';
            $_SESSION['is_admin'] = TRUE;
            header('Location: ../admin');
        } else {
            try {
                $query_user = 'SELECT * FROM `user` WHERE email = :email';
                $statement = $db->prepare($query_user);
                $statement->bindValue(':email', $email);
                $statement->execute();
                $user = $statement->fetch();
                $statement->closeCursor();

                if (isset($user['email'])) {
                    if ($password == $user['password']) {
                        $_SESSION['email'] = $email;
                        $_SESSION['user_name'] = $user['firstName'].' '.$user['lastName'];
                        $_SESSION['user_id'] = $user['userId'];
                        $_SESSION['is_admin'] = FALSE;
                        
                        // Mark user as online:
                        set_user_status($_SESSION['user_id'], USER_STAT_ONLINE);
                        
                        header('Location: ../quiz');
                    } else {
                        $creation_status = 1;
                    }
                } else {
                    $creation_status = 1;
                }
            } catch (PDOException $e) {
                echo $e;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- H<link rel="stylesheet" href="../css/bootstrap-theme.min.css"> -->
        <link rel="stylesheet" href="css/login.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="../js/jquery-2.2.4.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="../css/toastr.min.css">
        <script src="../js/toastr.min.js"></script>
    </head>
    <body>
        <?php
            if ($creation_status == 1) {
                show_error('Incorrect email and/or password');
            }
        ?>
        <main class="container">
            <div class="panel panel-default" style="text-align: center">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 form-container">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <h1 class="text-center">Log in</h1>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <button class="btn btn-primary btn-block">Sign in</button>
                                <a class="btn btn-danger btn-block" href="register.php">Sign up</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>